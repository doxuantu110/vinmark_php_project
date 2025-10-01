<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Notifications\Notifiable;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('clients.auth.forgot_password');
    }
    
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.exists' => 'Email không tồn tại trong hệ thống.',
        ]);
        // Send reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if ($status == Password::RESET_LINK_SENT) {
            toastr()->success('Đường dẫn đặt lại mật khẩu đã được gửi đến email của bạn.');
            return back()->with(['status' => __($status)]);
        } else {
            toastr()->error('Có lỗi xảy ra khi gửi đường dẫn đặt lại mật khẩu. Vui lòng thử lại.');
            return back()->withErrors(['email' => __($status)]);
        }
    }
}
