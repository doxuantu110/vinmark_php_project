<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.pages.profile', compact('user'));
    }

    public function update(Request $request)
    {
        // Lấy user hiện tại (đang dùng guard 'admin' như trong ảnh)
        $user = Auth::guard('admin')->user();

        // 1. Xử lý cập nhật thông tin cơ bản (Profile)
        if ($request->type === "profile") {
            $request->validate([
                "name" => "required|string|min:3",
                "phone" => "nullable|string|max:15",
                "address" => "required|string",
                "email" => "required|email|unique:users,email," . $user->id, // Validate email (bỏ qua chính user hiện tại)
            ]);

            $user->update([
                "name" => $request->name,
                "email" => $request->email, // Đã thêm dòng này
                "phone_number" => $request->phone,
                "address" => $request->address,
            ]);

            return response()->json([
                "status" => true,
                "message" => "Cập nhật thông tin thành công!"
            ]);
        }

        // 2. Xử lý đổi mật khẩu (Password)
        elseif ($request->type === "password") {
            $request->validate([
                "current_password" => "required",
                "new_password" => "required|min:6",
                "confirm_password" => "required|same:new_password",
            ]);

            // Kiểm tra mật khẩu cũ
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    "status" => false,
                    "message" => "Mật khẩu hiện tại không đúng!"
                ]);
            }

            // Cập nhật mật khẩu mới
            $user->update([
                "password" => Hash::make($request->new_password)
            ]);

            // LƯU Ý: Trong ảnh gốc của bạn đoạn này message bị copy nhầm là "Mật khẩu hiện tại không đúng"
            // Mình đã sửa lại thành message thành công.
            return response()->json([
                "status" => true,
                "message" => "Đổi mật khẩu thành công!"
            ]);
        }

        // 3. Xử lý ảnh đại diện (Avatar)
        elseif ($request->type === "avatar" && $request->hasFile("avatar")) {
            // Xóa ảnh cũ nếu tồn tại trong disk public
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $request->file("avatar");
            // Tạo tên file unique
            $fileName = now()->timestamp . '_' . uniqid() . '.' . $avatarPath->getClientOriginalExtension();
            // Lưu vào thư mục uploads/users
            $storedPath = $avatarPath->storeAs('uploads/users', $fileName, 'public');

            // Cập nhật đường dẫn vào DB
            $user->avatar = $storedPath;
            $user->save();

            return response()->json([
                "status" => true,
                "message" => "Cập nhật ảnh đại diện thành công!",
                "avatar_url" => asset('storage/' . $storedPath),
            ]);
        }

        // Trường hợp không khớp type nào
        return response()->json([
            "status" => false,
            "message" => "Yêu cầu không hợp lệ!"
        ]);
    }
}
