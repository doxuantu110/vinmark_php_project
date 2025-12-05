<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    // Hiển thị danh sách liên hệ
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('admin.pages.contacts', compact('contacts'));
    }


    public function replyContact(Request $request)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'contact_id' => 'required|exists:contacts,id',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $id = $request->contact_id;
        $email = $request->email;
        $messageContent = $request->message;

        try {

            // 2. Gửi Email
            Mail::send(
                'admin.emails.reply-contact',
                ['messageContent' => $messageContent],
                function ($message) use ($email) {
                    $message->to($email)
                        ->subject('Phản hồi liên hệ từ Vinmark');
                }
            );


            // 3. Cập nhật trạng thái liên hệ đã trả lời
            Contact::where('id', $id)->update(['is_replyed' => 1]);
            
            return response()->json([
                'status' => true,
                'message' => 'Đã gửi email phản hồi thành công!'
            ]);
        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => 'Gửi mail thất bại. Vui lòng kiểm tra lại cấu hình mail!' .$th->getMessage(),
            ], 500);
        }
    }
}
