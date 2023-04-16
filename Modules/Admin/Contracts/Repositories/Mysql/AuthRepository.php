<?php

namespace Modules\Admin\Contracts\Repositories\Mysql;

use App\Models\AdminLogin;
use Modules\Admin\Http\Requests\AdminLogin\AdminLoginRequest;

interface AuthRepository
{

    public function findById(int $adminId);

    public function login(AdminLoginRequest $request);
}
