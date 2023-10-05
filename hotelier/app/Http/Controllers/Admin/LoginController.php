<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('admins.auth.login');
    }

    public function handleForm(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            // Authentication successful
            return redirect()->route('admin.dashboard')-> with('success', 'Đăng nhập thành công');
        } else {
            // Authentication failed
            return redirect()->route('admin.login')-> with('error', 'Đăng nhập thất bại!');
        }
    }

    public function logout()    
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')-> with('success', 'Logout successfully');
    }
}
