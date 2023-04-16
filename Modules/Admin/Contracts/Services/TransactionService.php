<?php

namespace Modules\Admin\Contracts\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface TransactionService
{
    public function getAllOrder(Request $request);

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    public function show(int $id): Model;

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
//    public function totalMoney();
}
