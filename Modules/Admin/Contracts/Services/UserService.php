<?php

namespace Modules\Admin\Contracts\Services;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

interface UserService
{
    /**
     * @return LengthAwarePaginator
     */
    public function getList(Request $request): LengthAwarePaginator;

    /**
     * @param $id
     * @return mixed
     */
    public function findByField($id);

    /**
     * @param $name
     * @return mixed
     */
    public function findWhere($customerId);

    /**
     * @param $params
     * @return mixed
     */
    public function update($params);

    /**
     * @return BinaryFileResponse
     */
    public function exportCSV(Request $request);

    /**
     * @param int $id
     * @return mixed
     */
    public function showProfile(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function getOrderUser(int $id);
}
