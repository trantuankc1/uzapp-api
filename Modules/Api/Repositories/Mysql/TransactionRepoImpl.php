<?php

namespace Modules\Api\Repositories\Mysql;

use App\Models\Transaction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Api\Constants\TransactionStatus;
use Modules\Api\Contracts\Repositories\Mysql\TransactionRepository;

class TransactionRepoImpl implements TransactionRepository
{
    private Transaction $model;

    public function __construct(Transaction $transactions)
    {
        $this->model = $transactions;
    }

    public function save(Transaction $transaction): Transaction
    {
        $transaction->save();

        return $transaction;
    }

    public function updateStatus(string $transNo, string $openId): int
    {
        return $this->model->query()
            ->where('trans_no', $transNo)
            ->where('open_id', $openId)
            ->update(['trans_status' => TransactionStatus::SUCCESS]);
    }

    public function getLatestRecord(): Model|Builder|null
    {
        return $this->model->query()
            ->latest('id')
            ->first();
    }

    public function findByTransNoAndOpenId(string $transNo, string $openId): Model|Builder|null
    {
        return $this->model->query()
            ->where('trans_no', $transNo)
            ->where('open_id', $openId)
            ->first();
    }

    public function findByTransNoPendingAndOpenId(string $transNo, string $openId): ?Model
    {
        return $this->model->query()
            ->where('trans_no', $transNo)
            ->where('open_id', $openId)
            ->where('trans_status', TransactionStatus::PENDING)
            ->first();
    }

    public function getAllByOpenId(string $openId, ?int $paginate = 10): LengthAwarePaginator
    {
        return $this->model->query()
            ->with('transactionProduct:trans_no,product_name')
            ->where('open_id', $openId)
            ->paginate($paginate);
    }

    public function getAllByTransNoAndOpenId(string $transNo, string $openId): Collection
    {
        return $this->model->query()
            ->with('transactionProduct')
            ->where('trans_no', $transNo)
            ->where('open_id', $openId)
            ->get();
    }
}
