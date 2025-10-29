<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('clients.pages.contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate(
            [

                'name'  => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|numeric|digits_between:10,15',
            ],
            [
                'name.required'  => 'Tên là bắt buộc.',
                'email.required' => 'Email là bắt buộc.',
                'phone.required' => 'Số điện thoại là bắt buộc.',
            ]
        );

        Contact::create(
            attributes: [
                'full_name'   => $request->name,
                'phone_number' => $request->phone,
                'email'       => $request->email,
                'message'     => $request->message,
                'is_replied'  => 0,
            ]
        );

        toastr()->success(message: 'Gửi thành công! Quản trị viên sẽ sớm liên hệ với bạn.');

        return redirect()->back();
    }
}
