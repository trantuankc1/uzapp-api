<?php

namespace Modules\Api\Contracts\Repositories\Mysql;

use App\Models\Transaction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface TransactionRepository
{
    public function save(Transaction $transaction): Transaction;

    public function updateStatus(string $transNo, string $openId): int;

    public function getLatestRecord(): Model|Builder|null;

    public function findByTransNoAndOpenId(string $transNo, string $openId): Model|Builder|null;

    public function findByTransNoPendingAndOpenId(string $transNo, string $openId): ?Model;

    public function getAllByOpenId(string $openId, ?int $paginate): LengthAwarePaginator;

    public function getAllByTransNoAndOpenId(string $transNo, string $openId): Collection;
}
