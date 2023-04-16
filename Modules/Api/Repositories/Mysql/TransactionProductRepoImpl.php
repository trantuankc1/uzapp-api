<?php

namespace Modules\Api\Repositories\Mysql;

use App\Models\TransactionProduct;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\Api\Constants\TransactionProductStatus;
use Modules\Api\Contracts\Repositories\Mysql\TransactionProductRepository;

class TransactionProductRepoImpl implements TransactionProductRepository
{
    private TransactionProduct $model;

    public function __construct(TransactionProduct $transactionProduct)
    {
        $this->model = $transactionProduct;
    }

    public function save(TransactionProduct $transactionProduct): TransactionProduct
    {
        $transactionProduct->save();

        return $transactionProduct;
    }

    public function updateStatus(string $transNo, string $openId): int
    {
        return TransactionProduct::query()
            ->where('trans_no', $transNo)
            ->where('open_id', $openId)
            ->update(['export_status' => TransactionProductStatus::SUCCESS]);
    }

    public function getAllByTransNoAndOpenId(string $transNo, string $openId, ?int $paginate = 10): LengthAwarePaginator
    {
        return TransactionProduct::query()
            ->with('transaction')
            ->where('trans_no', $transNo)
            ->where('open_id', $openId)
            ->paginate($paginate);
    }
}
