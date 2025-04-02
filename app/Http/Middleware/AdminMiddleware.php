<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request); // Cho phép tiếp tục truy cập
        }

        // Nếu không phải admin thì chuyển về trang chủ
        return redirect('/');
    }
}
