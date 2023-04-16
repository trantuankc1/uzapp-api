<?php

namespace Modules\Api\Contracts\Repositories\Mysql;

use App\Models\TransactionProduct;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface TransactionProductRepository
{
    public function save(TransactionProduct $transactionProduct): TransactionProduct;

    public function updateStatus(string $transNo, string $openId): int;

    public function getAllByTransNoAndOpenId(string $transNo, string $openId, ?int $paginate);
}
