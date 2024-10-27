<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
//    public function handle($request, Closure $next, ...$guards)
//    {
//        $this->guards = $guards;
//
//        parent::handle($request, $next, ...$guards);
//    }

    protected function redirectTo($request)
    {
//        dd(data_get($this->guards, 0));

        if($request->is('admin/*')) {
            return route('admin.login');
        }

        if (static::$redirectToCallback) {
            return call_user_func(static::$redirectToCallback, $request);
        }
    }
}
