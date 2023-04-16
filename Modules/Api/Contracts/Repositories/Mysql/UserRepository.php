<?php

namespace Modules\Api\Contracts\Repositories\Mysql;

use App\Models\User;

interface UserRepository
{
    /**
     * Save User to database
     *
     * @param User $user
     * @return User
     */
    public function save(User $user): User;

    /**
     * @param int $open_id
     * @return mixed
     */
    public function findByOpenId(string $openId);

    /**
     * @param User $id
     * @return mixed
     */
    public function edit(int $id);

    /**
     * @param User $user
     * @return mixed
     */
    public function updateUser(User $user);

}
