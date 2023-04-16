<?php

namespace Modules\Admin\Services;

use App\Models\AdminLogin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Http\Requests\AdminLogin\AdminLoginRequest;
use Modules\Admin\Contracts\Repositories\Mysql\AuthRepository;
use Modules\Admin\Contracts\Services\AuthService;

class AuthServiceImpl implements AuthService
{
    /**
     * @var AuthRepository
     */
    protected AuthRepository $authRepository;

    /**
     * @param AuthRepository $authRepository
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @param AdminLoginRequest $request
     * @return RedirectResponse
     */
    public function login(AdminLoginRequest $request): RedirectResponse
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($credentials)) {
            if ($request->session()->has('url_tmp')) {
                return redirect($request->session()->get('url_tmp'));
            }
            return redirect()->route('order');
        }

        return redirect()->route('admin::login')->with('error', 'Username or Password entered incorrectly.');
    }
}
