<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('role')->paginate(9);
        return view('admin.pages.users', compact('users'));
    }

    public function upgrade(Request $request)
    {
        $userId = $request->user_id;
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy người dùng',
            ]);
        }

        // Đặt role thành staff
        $user->role_id = 2;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Đã nâng cấp thành nhân viên.'
        ]);
    }

    public function updateStatus(Request $request){
        $userId = $request->user_id;
        $newStatus = $request->status;

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy người dùng',
            ]);
        }

        // Cập nhật trạng thái người dùng
        $user->status = $newStatus;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Trạng thái người dùng đã được cập nhật.'
        ]);
    }
}
