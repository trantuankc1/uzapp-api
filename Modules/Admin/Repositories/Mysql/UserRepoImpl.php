<?php

namespace Modules\Admin\Repositories\Mysql;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Admin\Contracts\Repositories\Mysql\UserRepository;

class UserRepoImpl implements UserRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function getListWithFilter(array $filters, $paginator = 20): LengthAwarePaginator
    {
        return User::query()->select('id', 'person_name', 'gender', 'phone', 'birthday', 'email')
            ->where($filters)
            ->orderByDesc('id')
            ->paginate($paginator);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findByField($id)
    {
        return User::query()->select('id', 'person_name', 'gender', 'phone', 'birthday', 'email')
            ->where('id', $id)
            ->first();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function findWhere($customerId)
    {
        return User::where('id', $customerId)->select(
            'id',
            'person_name',
            'sex',
            'mobile_phone',
            'birthday',
            'email'
        ) ->paginate(10);
    }

    /**
     * @param $params
     * @return mixed|void
     */
    public function update($params)
    {
        $user = User::where('id', $params['id'])->first();

        $user->fill($params);

        $user->save();
    }

    public function showProfile(int $id)
    {
        return User::query()
            ->with('transaction')
            ->where('status', 1)
            ->where('id', $id)
            ->first();
    }

    public function getOrderUser(int $id)
    {
        // TODO: Implement getOrderUser() method.
    }
}
