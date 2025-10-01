<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        return view('clients.auth.reset_password', ['token' => $token]);
    }
    
    public function reset(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6|confirmed',
                'token' => 'required'
            ],
            [
                'email.required' => 'Email là bắt buộc.',
                'email.email' => 'Email không hợp lệ.',
                'password.required' => 'Mật khẩu là bắt buộc.',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
                'token.required' => 'Token đặt lại mật khẩu là bắt buộc.'
            ]
        );

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            toastr()->success('Mật khẩu của bạn đã được đặt lại thành công! Vui lòng đăng nhập với mật khẩu mới.');
            return redirect()->route('login');
        } else {
            toastr()->error('Không thể đặt lại mật khẩu. Vui lòng thử lại.');
            return back()->withErrors(['email' => __($status)]);
        }
    }   
}