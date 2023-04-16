<?php

namespace Modules\Admin\Contracts\Services;

use App\Models\AdminLogin;
use Illuminate\Http\RedirectResponse;
use Modules\Admin\Http\Requests\AdminLogin\AdminLoginRequest;

interface AuthService
{
    /**
     * @param AdminLoginRequest $request
     */
    public function login(AdminLoginRequest $request);
}
