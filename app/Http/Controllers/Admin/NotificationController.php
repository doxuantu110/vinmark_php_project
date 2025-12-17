<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('is_read', 0)->latest('created_at')->get();

        foreach ($notifications as $noti) {
            if ($noti->type === 'order') $noti->title = "Có đơn hàng mới";
            else if ($noti->type === 'contact') $noti->title = "Có liên hệ mới";
            else if ($noti->type === 'wishlist') $noti->title = "Sản phẩm yêu thích";
        }

        return view('admin.pages.notifications', compact('notifications'));
    }

    public function markAsRead(Request $request)
    {
        Notification::where('id', $request->id)->update(['is_read' => 1]);
        return response()->json(['status' => true]);

    }
}
