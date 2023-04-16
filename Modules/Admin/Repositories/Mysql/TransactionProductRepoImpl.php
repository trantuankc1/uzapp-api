<?php

namespace Modules\Admin\Repositories\Mysql;

use App\Models\Transaction;
use App\Models\TransactionProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Admin\Contracts\Repositories\Mysql\TransactionProductsRepository;

class TransactionProductRepoImpl implements TransactionProductsRepository
{
    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        TransactionProduct::destroy($id);
    }

    /**
     * @param int $id
     * @return Builder|Model|object|null
     */
    public function getOrderDetail(int $id)
    {
        return Transaction::query()
            ->with('transactionProduct')
            ->where('trans_no', $id)
            ->first();
    }
}
