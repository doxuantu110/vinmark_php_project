<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'ltn__address'=> 'nullable|string|max:255',
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
}
