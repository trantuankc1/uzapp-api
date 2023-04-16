<?php

namespace Modules\Api\Repositories\Mysql;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Api\Contracts\Repositories\Mysql\UserRepository;
use Modules\Api\Repositories\Auth;

class UserRepoImpl implements UserRepository
{
    /**
     * Save User to database
     *
     * @param User $user
     * @return User
     */
    public function save(User $user): User
    {
        $user->save();

        return $user;
    }

    /**
     * Get User by id
     *
     * @param string $openId
     * @return Model
     */
    public function findByOpenId(string $openId): Model
    {
        return User::query()
            ->select('id', 'open_id', 'email', 'person_name', 'phone', 'birthday', 'gender', 'state', 'status')
            ->where('status', 1)
            ->where( 'open_id', $openId)
            ->first();
    }

    /**
     * @param int $openId
     * @return bool|mixed
     */
    public function edit(int $openId)
    {
        $openId = \Illuminate\Support\Facades\Auth::guard('api')->user()->open_id;

        return User::findOrFail($openId);
    }

    /**
     * @param User $user
     * @return User
     */
    public function updateUser(User $user): User
    {
        $user->update($user->toArray());

        return $user;
    }
}
