<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionProduct;
use App\Models\User;
use App\Notifications\TransactionNotifitionMail;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;
use Modules\Admin\Contracts\Services\TransactionService;


class TransactionController extends Controller
{
    /**
     * @var TransactionService
     */
    protected TransactionService $transactionService;

    /**
     * @param TransactionService $transactionService
     */
    public function __construct(TransactionService $transactionService)
    {
        $this->middleware('checkLoginAdmin');
        $this->transactionService = $transactionService;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $orders = $this->transactionService->getAllOrder($request);
        $totalMoney = $orders->totalMoney;

        return view('admin::pages.order.index', compact('orders', 'totalMoney'));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function update(int $id): RedirectResponse
    {
        $this->transactionService->update($id);

        return back();
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function active(int $id)
    {
        $this->transactionService->active($id);

        return back();
    }

    /**
     * @return mixed
     */
    public function totalMoney(): mixed
    {
        $total = 0;
        $data = TransactionProduct::with('transaction', 'user', 'product')->get();
        foreach ($data as $value)
        {
            $total += $value->product_pay_amount;
        }

        return $total;
    }

    public function show(int $id)
    {
        $transaction = $this->transactionService->show($id);

        return view('admin::pages.order.orderDetail', compact('transaction'));
    }
}
