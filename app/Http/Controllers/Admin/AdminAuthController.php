<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm(){
        return view("admin.pages.login");
    }

    public function login(Request $request)
{
    // ✅ Kiểm tra dữ liệu đầu vào
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    // ✅ Thử đăng nhập với guard admin
    if (Auth::guard('admin')->attempt([
        'email' => $request->email,
        'password' => $request->password 
    ])) {
        $user = Auth::guard('admin')->user();

        // ✅ Kiểm tra quyền truy cập (chỉ cho phép admin hoặc staff)
         if (in_array($user->role->name, ['admin', 'staff'])) {
            $request->session()->regenerate();
            toastr()->success('Đăng nhập admin thành công!');
            return redirect()->route('admin.dashboard');
        }
        // ❌ Không có quyền admin thì đăng xuất ngay
        Auth::guard('admin')->logout();
        toastr()->error('Bạn không có quyền truy cập khu vực quản trị.');
        return back();
    }

    // ❌ Sai thông tin đăng nhập
    toastr()->error('Email hoặc mật khẩu không chính xác.');
    return back()->withInput($request->only('email'));
}
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công!');
    }

}
