<?php

namespace Modules\Admin\Repositories\Mysql;

use App\Models\Transaction;
use App\Models\TransactionProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Contracts\Repositories\Mysql\TransactionRepository;

class TransactionRepoImpl implements TransactionRepository
{

    public function getAllOrder(array $filters, $paginator = 20)
    {
        $queries = Transaction::query()->orderByDesc('id');
        if (isset($filters['order'])) {
            $queries->where($filters['order']);
        }

        if (isset($filters['person_name'])) {
            $queries->whereHas('user', function ($user) use ($filters) {
                $user->where($filters['person_name']);
            });
        }

        return $queries->paginate($paginator);
    }

    /**
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function findId(int $id)
    {
        return Transaction::query()->findOrFail($id);
    }

    public function findByIdWithTransactionProduct(int $id): Model
    {
        return Transaction::query()
            ->with('transactionProduct')
            ->where('id', $id)
            ->first();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function active(int $id)
    {
        return Transaction::where('id', $id)->update(['status' => 2]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deActive(int $id)
    {
        return Transaction::where('id', $id)->update(['trans_status' => 1]);
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function update(int $id)
    {
        // TODO: Implement update() method.
    }

    /**
     */
    public function getSumTotalMoneyWithFilter(array $filters)
    {
        $queries = Transaction::query();
        if (isset($filters['order'])) {
            $queries->where($filters['order']);
        }

        if (isset($filters['person_name'])) {
            $queries->whereHas('user', function ($user) use ($filters) {
                $user->where($filters['person_name']);
            });
        }

        return $queries->sum('trans_pay_amount');
    }
}
