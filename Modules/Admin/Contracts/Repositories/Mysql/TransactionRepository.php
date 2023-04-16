<?php

namespace Modules\Admin\Contracts\Repositories\Mysql;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface TransactionRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function getAllOrder(array $filters, $paginator = 20);

    /**
     * @return mixed
     */
    public function findId(int $id);

    public function findByIdWithTransactionProduct(int $id): Model;

    /**
     * @param int $id
     * @return mixed
     */
    public function update(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function active(int $id);

    /**
     * @return mixed
     */
    public function getSumTotalMoneyWithFilter(array $filters);

}
