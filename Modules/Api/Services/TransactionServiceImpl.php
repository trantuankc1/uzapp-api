<?php

namespace Modules\Api\Services;

use App\Exceptions\ApiException;
use App\Mail\NotifyCreateOrder;
use App\Models\Transaction;
use App\Models\TransactionProduct;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Api\Constants\TransactionProductStatus;
use Modules\Api\Constants\TransactionStatus;
use Modules\Api\Contracts\Repositories\Mysql\ProductRepository;
use Modules\Api\Contracts\Repositories\Mysql\TransactionProductRepository;
use Modules\Api\Contracts\Repositories\Mysql\TransactionRepository;
use Modules\Api\Contracts\Services\PaymentService;
use Modules\Api\Contracts\Services\TransactionService;
use Exception;

class TransactionServiceImpl implements TransactionService
{
    private TransactionRepository $transactionRepository;
    private TransactionProductRepository $transactionProductRepository;
    private ProductRepository $productRepository;

    private StatefulGuard|Guard $auth;
    private PaymentService $paymentService;

    public function __construct(TransactionRepository        $transactionRepository,
                                TransactionProductRepository $transactionProductRepository,
                                ProductRepository            $productRepository,
                                PaymentService               $paymentService)
    {
        $this->auth = Auth::guard('api');
        $this->transactionRepository = $transactionRepository;
        $this->transactionProductRepository = $transactionProductRepository;
        $this->productRepository = $productRepository;
        $this->paymentService = $paymentService;
    }

    /**
     * @param string $transNo
     * @return Model|Builder|null
     */
    public function findByTransNo(string $transNo): Model|Builder|null
    {
        $openId = $this->auth->user()->open_id;

        return $this->transactionRepository->findByTransNoAndOpenId($transNo, $openId);
    }

    public function getTransactionHistoryList(): LengthAwarePaginator
    {
        $openId = $this->auth->user()->open_id;

        return $this->transactionRepository->getAllByOpenId($openId);
    }

    public function generateTransNo(string $transConfirmNo): string
    {
        return Carbon::now()->timestamp . $transConfirmNo;
    }

    public function generateTransConfirmNo(int $lastIdTransaction): string
    {
        return str_pad($lastIdTransaction, 5, '0', STR_PAD_LEFT);
    }

    public function getTransactionDetail(string $transNo)
    {
        $openId = $this->auth->user()->open_id;

        return $this->transactionRepository->getAllByTransNoAndOpenId($transNo, $openId);
    }

    /**
     * @throws Exception
     */
    public function createOrder(Request $request): Transaction
    {
        try {
            DB::beginTransaction();
            $openId = $this->auth->user()->open_id;
            $requestProducts = $request->input('products');
            $requestProductIds = array_column($requestProducts, 'product_id');
            $products = $this->productRepository->getProductByIds($requestProductIds);
            if (count($products) < count($requestProducts)) {
                throw ApiException::badRequest('Product invalid');
            }

            $totalMoney = 0;
            foreach ($products as $product) {
                foreach ($requestProducts as $key => $requestProduct) {
                    if ($requestProduct['product_id'] == $product->id) {
                        $totalMoney += $product->price * $requestProduct['quantity'];
                        $product->quantity -= $requestProduct['quantity'];
                        $product->save();
                        $requestProducts[$key]['name'] = $product->name;
                        $requestProducts[$key]['price'] = $product->price;
                    }
                }
            }

            $lastTransaction = $this->transactionRepository->getLatestRecord();
            $lastIdTransaction = !$lastTransaction ? 1 : $lastTransaction->id + 1;
            $transConfirmNo = $this->generateTransConfirmNo($lastIdTransaction);
            $transNo = $this->generateTransNo($transConfirmNo);

            $transaction = new Transaction();
            $transaction->open_id = $openId;
            $transaction->liff_msg_access_token = $request->input('liff_msg_access_token');
            $transaction->liff_notification_token = $request->input('liff_notification_token');
            $transaction->trans_no = $transNo;
            $transaction->trans_confirm_no = $transConfirmNo;
            $transaction->trans_origin_amount = $totalMoney;
            $transaction->pay_method = $request->input('pay_method');
            $transaction->receive_method = $request->input('receive_method');
            $transaction->trans_pay_amount = $totalMoney;
            $transaction->take_date = Carbon::now()->toDateString();
            $transaction->zipcode = $request->input('zipcode');
            $transaction->district = $request->input('district');
            $transaction->town = $request->input('street');
            $transaction->address = $request->input('building');
            $transaction->mobile_phone = $request->input('phone_number');
            $transaction->trans_status = TransactionStatus::PENDING;
            $this->transactionRepository->save($transaction);

            foreach ($products as $product) {
                foreach ($requestProducts as $requestProduct) {
                    if ($requestProduct['product_id'] == $product->id) {
                        $transactionProduct = new TransactionProduct();
                        $transactionProduct->open_id = $openId;
                        $transactionProduct->trans_no = $transNo;
                        $transactionProduct->product_id = $product->id;
                        $transactionProduct->product_name = $product->name;
                        $transactionProduct->product_quantity = $requestProduct['quantity'];
                        $transactionProduct->product_origin_amount = $product->price;
                        $transactionProduct->product_discount_amount = 0;
                        $transactionProduct->product_pay_amount = $product->price * $requestProduct['quantity'];
                        $transactionProduct->export_status = TransactionStatus::PENDING;
                        $transactionProduct->last_used_time = Carbon::now();
                        $transactionProduct->used_counts = 0;
                        $this->transactionProductRepository->save($transactionProduct);
                    }
                }
            }

            $createPaymentIntent = $this->paymentService->initPayment($transaction);
            if ($createPaymentIntent) {
                $transaction->payment_intent_id = $createPaymentIntent["paymentIntentId"];
                $transaction->payment_client_secret = $createPaymentIntent["clientSecret"];
                $transaction->save();
                $transaction->payment = $createPaymentIntent;
            }

            Mail::to($this->auth->user()->email)->queue(new NotifyCreateOrder($transaction, $requestProducts));

            DB::commit();
            return $transaction;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function updatePaymentSuccess(string $retrieve): bool
    {
        $createPaymentIntent = $this->paymentService->getPaymentInfoByIntent($retrieve);
        if (!$createPaymentIntent) {
            throw ApiException::notFound();
        }
        if ($createPaymentIntent['status'] != 'succeeded') {
            throw ApiException::badRequest();
        }

        $openId = $this->auth->user()->open_id;
        $this->transactionRepository->updateStatus($createPaymentIntent['transaction']['transNo'], $openId);
        $this->transactionProductRepository->updateStatus($createPaymentIntent['transaction']['transNo'], $openId);

        return true;
    }

    /**
     * @throws Exception
     */
    public function paymentCancel(string $transNo): bool
    {
        try {
            DB::beginTransaction();
            $openId = $this->auth->user()->open_id;
            $transaction = $this->transactionRepository->findByTransNoPendingAndOpenId($transNo, $openId);
            if (!$transaction) {
                return false;
            }

            $this->paymentService->paymentCancel($transaction->payment_intent_id);
            $transaction->trans_status = TransactionStatus::CANCEL;
            $transaction->save();
            $requestProducts = [];
            foreach ($transaction->transactionProduct()->get() as $transactionProduct) {
                $transactionProduct->export_status = TransactionProductStatus::CANCEL;
                $requestProducts[] = [
                    'product_id' => $transactionProduct->product_id,
                    'quantity' => $transactionProduct->product_quantity
                ];
                $transactionProduct->product->quantity += $transactionProduct->quantity;
                $transactionProduct->save();
            }

            $requestProductIds = array_column($requestProducts, 'product_id');
            $products = $this->productRepository->getProductByIds($requestProductIds);
            foreach ($products as $product) {
                foreach ($requestProducts as $requestProduct) {
                    if ($requestProduct['product_id'] == $product->id) {
                        $product->quantity += $requestProduct['quantity'];
                        $product->save();
                    }
                }
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
