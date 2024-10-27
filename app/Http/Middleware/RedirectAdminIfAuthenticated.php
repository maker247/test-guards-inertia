<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class RedirectAdminIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        $adminUser = auth('admin')->user() ?? null; // check if the admin user is logged in

        if ($adminUser) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
