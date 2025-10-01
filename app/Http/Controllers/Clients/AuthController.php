<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Clients\ForgotPasswordController;
use App\Http\Controllers\Clients\ResetPasswordController;
class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('clients.pages.register');
    }

    public function register(Request $request)
    {
        // Validate the request data
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ],
            [
                'name.required' => 'Tên là bắt buộc.',
                'email.required' => 'Email là bắt buộc.',
                'email.email' => 'Email không hợp lệ.',
                'email.unique' => 'Email đã được sử dụng.',
                'password.required' => 'Mật khẩu là bắt buộc.',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            ]
        );

        // check if email exists
        $existingUser = \App\Models\User::where('email', $request->email)->first();
        if ($existingUser) {
            if ($existingUser->isPending()) {
                toastr()->error('Email đã được đăng ký nhưng chưa được kích hoạt. Vui lòng kiểm tra email của bạn để kích hoạt tài khoản.');
                return redirect()->route('register');
            }
        }

        // create token activation
        $token = \Illuminate\Support\Str::random(64);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'activation_token' => $token,
            'status' => 'pending',
            'role_id' => 3, // default role is user
        ]);

        Mail::to($user->email)->send(new \App\Mail\ActivationMail($token, $user));

        toastr()->success('Đăng ký thành công! Vui lòng kiểm tra email của bạn để kích hoạt tài khoản.');
        return redirect()->route('login');
    }

    public function activateAccount($token)
    {
        $user = \App\Models\User::where('activation_token', $token)->first();

        if (!$user) {
            toastr()->error('Token kích hoạt không hợp lệ hoặc đã hết hạn.');
            return redirect()->back();
        }

        $user->status = 'active';
        $user->activation_token = null;
        $user->save();

        toastr()->success('Tài khoản của bạn đã được kích hoạt thành công! Bây giờ bạn có thể đăng nhập.');
        return redirect()->route('login');
    }

    public function showLoginForm()
    {
        return view('clients.pages.login');
    }

    public function login(Request $request)
{
    // Validate
    $request->validate(
        [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ],
        [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ]
    );

    // Check login
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
        if (in_array(Auth::user()->role_id, [3])) { // chỉ cho phép customer
            $request->session()->regenerate();
            // Gửi thông báo qua Flasher và redirect kèm session flash để Toastr hiển thị sau redirect
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        } else {
            Auth::logout();
            return redirect()->back()->with('error', 'Bạn không có quyền truy cập vào khu vực này.');
        }
    }

    // Sai mật khẩu hoặc tài khoản chưa active
    Log::warning('Login failed for email: ' . $request->email);
    toastr()->error('Đăng nhập thất bại! Vui lòng kiểm tra lại email và mật khẩu, hoặc kích hoạt tài khoản nếu bạn chưa làm điều đó.');
    return redirect()->back()->with('error', 'Đăng nhập thất bại! Vui lòng kiểm tra lại email và mật khẩu.');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        toastr()->success('Đăng xuất thành công!');
        return redirect()->route('login');
    }

}
