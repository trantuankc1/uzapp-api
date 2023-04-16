<?php

namespace Modules\Admin\Contracts\Repositories\Mysql;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function getListWithFilter(array $filters, LengthAwarePaginator $paginator): LengthAwarePaginator;

    /**
     * @param $id
     * @return mixed
     */
    public function findByField($id);

    /**
     * @param $customerId
     * @return mixed
     */
    public function findWhere($customerId);

    /**
     * @param $params
     * @return mixed
     */
    public function update($params);

    /**
     * @param User $user
     * @return mixed
     */
    public function showProfile(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function getOrderUser(int $id);
}
