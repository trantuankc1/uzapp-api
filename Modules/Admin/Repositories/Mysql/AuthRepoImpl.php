<?php

namespace Modules\Admin\Repositories\Mysql;

use App\Models\AdminLogin;
use Modules\Admin\Contracts\Repositories\Mysql\AuthRepository;
use Modules\Admin\Http\Requests\AdminLogin\AdminLoginRequest;

class AuthRepoImpl implements AuthRepository
{

    /**
     * @param AdminLoginRequest $request
     * @return void
     */
    public function login(AdminLoginRequest $request)
    {
//        return AdminLogin::query()->select('email', 'password')->get();
    }

    /**
     * @param int $adminId
     * @return void
     */
    public function findById(int $adminId)
    {
        AdminLogin::query()->findOrFail($adminId);
    }
}
