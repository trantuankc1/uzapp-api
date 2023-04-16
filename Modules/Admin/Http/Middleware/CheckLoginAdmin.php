<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CheckLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            session()->put('url_tmp', $request->path());
            return redirect()->route('admin::login');
        }

        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }

        return $next($request);
    }

}
