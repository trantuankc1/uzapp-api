<?php

namespace Modules\Api\Http\Controllers;


use App\Models\User;
use App\Notifications\TransactionNotifitionMail;
use App\Transformers\ErrorResource;
use App\Transformers\SuccessResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Modules\Api\Contracts\Services\PaymentService;
use Modules\Api\Contracts\Services\TransactionService;

class TransactionController extends BaseController
{
    private TransactionService $transactionService;
    private PaymentService $paymentService;

    public function __construct(TransactionService $transactionService,
                                PaymentService $paymentService)
    {
        $this->transactionService = $transactionService;
        $this->paymentService = $paymentService;
    }

    public function index(): SuccessResource
    {
        $items = $this->transactionService->getTransactionHistoryList();
        return SuccessResource::make($items);
    }

    public function transactionDetail(string $transNo): ErrorResource|SuccessResource
    {
        $transaction = $this->transactionService->findByTransNo($transNo);
        if (!$transaction) {
            return new ErrorResource(404, 'Not found', $transNo);
        }

        $items = $this->transactionService->getTransactionDetail($transNo);
        return SuccessResource::make($items);
    }

    public function create(Request $request): SuccessResource
    {
        $transaction = $this->transactionService->createOrder($request);

        return SuccessResource::make($transaction);
    }

    public function paymentSuccess(string $retrieve): SuccessResource
    {
        $this->transactionService->updatePaymentSuccess($retrieve);
        return new SuccessResource();
    }

    public function paymentCancel(string $transNo): ErrorResource|SuccessResource
    {
        $cancel = $this->transactionService->paymentCancel($transNo);
        if (!$cancel) {
            return new ErrorResource(404, 'Not found', $transNo);
        }

        return new SuccessResource();
    }
}
