<?php

namespace Modules\Admin\Contracts\Repositories\Mysql;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface TransactionProductsRepository
{
    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void;

    /**
     * @param int $id
     * @return mixed
     */
    public function getOrderDetail(int $id);
}
