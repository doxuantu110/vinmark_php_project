<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('clients.pages.account', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate dữ liệu
        $request->validate([
            'ltn__name'   => 'required|string|max:255',
            'ltn__phonenumber'  => 'nullable|string|max:20',
            'ltn__address' => 'nullable|string|max:255',
            'avatar'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        // Xử lý upload avatar
        if ($request->hasFile('avatar')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $file = $request->file('avatar');

            // Tạo tên file mới
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Lưu file vào storage/app/public/uploads/users
            $avatarPath = $file->storeAs('uploads/users', $filename, 'public');

            // Lưu đường dẫn vào DB
            $user->avatar = $avatarPath;
        }
        // Cập nhật thông tin cơ bản
        $user->name    = $request->input('ltn__name');
        $user->phone_number   = $request->input('ltn__phonenumber');
        $user->address = $request->input('ltn__address');
        // Lưu thông tin user
        $user->save();

        // Trả về response JSON
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thông tin thành công!',
            'avatar'  => $user->avatar ? asset('storage/' . $user->avatar) : null,
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate(
            [
                'current_password'     => 'required',
                'new_password'         => 'required|min:6',
                'confirm_new_password' => 'required|same:new_password',
            ],
            [
                'current_password.required'     => 'Vui lòng nhập mật khẩu hiện tại',
                'new_password.required'         => 'Mật khẩu mới không được để trống',
                'new_password.min'              => 'Mật khẩu mới phải có ít nhất 6 ký tự',
                'confirm_new_password.required' => 'Vui lòng nhập lại mật khẩu mới.',
                'confirm_new_password.same'     => 'Mật khẩu nhập lại không khớp.',
            ]
        );


        $user = Auth::user();
        // Check if current password incorrect
        // Check if current password incorrect
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'errors' => [
                    'current_password' => ['Mật khẩu hiện tại không đúng!']
                ]
            ], 422);
        }
        // Update new password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Đổi mật khẩu thành công!'
        ]);
    }
}
