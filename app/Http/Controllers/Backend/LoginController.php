<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $email = $request->email ?? '';
        $password = $request->password ?? '';
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            if (Auth::check() && Auth::user()->role != 1) {
                return redirect()->route('backend.getLogin')->with('error', 'Bạn không có quyền truy cập!');
            }
            return redirect()->route('backend.category.index')->with('success', 'Đăng nhập thành công!');
        }
        return redirect()->route('backend.getLogin')->with('error', 'Đăng nhập thất bại!');
    }


    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        return redirect()->route('backend.getLogin')->with('success', 'Đăng xuất thành công!');
    }


    public function getLogin()
    {
        if (Auth::check() && Auth::user()->role == 1) {
            return redirect()->route('backend.product.index');
        }
        return view('backend.login');
    }

}
