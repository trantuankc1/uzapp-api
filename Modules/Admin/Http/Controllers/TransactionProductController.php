<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionProduct;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Contracts\Services\TransactionProductsService;

class TransactionProductController extends Controller
{
    /**
     * @var TransactionProductsService
     */
    protected TransactionProductsService $orderDetailService;

    public function __construct(TransactionProductsService $orderDetailService)
    {
        $this->orderDetailService = $orderDetailService;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function show(int $id): Renderable
    {
        $orderDetails = $this->orderDetailService->getOrderDetail($id);

        return view('admin::pages.order.orderDetail', compact('orderDetails'));
    }


    public function change(Request $request)
    {
        $transaction = Transaction::query()->find($request->orderId);
        $transaction->trans_status = $request->input('typeStatus');
        $transaction->update();
        foreach ($transaction->transactionProduct()->get() as $transactionProduct) {
            $transactionProduct->export_status = $request->input('typeStatus');
            $transactionProduct->save();
        }

        return redirect()->route('order')->with('Update Success');
    }

    /**
     * @return mixed
     */
    public function exportCsv(): mixed
    {
        return $this->orderDetailService->exportCsv();
    }

}
