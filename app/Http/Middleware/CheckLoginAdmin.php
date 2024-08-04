<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLoginAdmin
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 1) {
            return $next($request);
        }
        if (!Auth::check()) {
            return redirect()->route('backend.getLogin')->with('error', 'Bạn cần phải đăng nhập!');
        }
        return redirect()->route('backend.getLogin')->with('error', 'Bạn không có quyền truy cập!');
    }
}
