<?php

namespace Modules\Admin\Contracts\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface TransactionProductsService
{
    /**
     * @param int $id
     * @return Collection
     */
    public function getOrderDetail(int $id);

    /**
     * @return mixed
     */
    public function exportCsv();
}
