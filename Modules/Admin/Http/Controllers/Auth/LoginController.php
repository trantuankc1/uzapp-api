<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Modules\Admin\Contracts\Services\AuthService;
use Modules\Admin\Http\Requests\AdminLogin\AdminLoginRequest;

class LoginController extends Controller
{
    /**
     * @var AuthService
     */
    public AuthService $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->middleware('guest');
    }

    /**
     * @return View
     */
    public function login(): View
    {
        return view('admin::pages.adminLogin.login');
    }

    /**
     * @param AdminLoginRequest $request
     * @return mixed
     */
    public function postLogin(AdminLoginRequest $request)
    {
        return $this->authService->login($request);
    }

}
