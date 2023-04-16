<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LogOutController extends Controller
{
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin::login');
    }
}
