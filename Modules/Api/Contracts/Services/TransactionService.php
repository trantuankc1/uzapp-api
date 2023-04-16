<?php

namespace Modules\Api\Contracts\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface TransactionService
{
    public function findByTransNo(string $transNo): Model|Builder|null;

    public function getTransactionHistoryList(): LengthAwarePaginator;

    public function getTransactionDetail(string $transNo);

    public function createOrder(Request $request);

    public function updatePaymentSuccess(string $retrieve): bool;

    public function paymentCancel(string $transNo);
}
