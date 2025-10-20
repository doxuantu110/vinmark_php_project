<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $addresses = ShippingAddress::where('user_id', $user->id)->get();
        $defaultAddress = $addresses->where('default', true)->first();
        if(is_null($defaultAddress) || is_null($addresses)){
            toastr()->error('Vui lòng thêm địa chỉ giao hàng trước khi thanh toán.');
            return redirect()->route('account');
        }
        
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        return view('clients.pages.checkout', compact('addresses', 'defaultAddress', 'cartItems', 'totalPrice'));
    }

    // get address for checkout page ajax
    public function getAddress(Request $request){
        $address = ShippingAddress::where('id', $request->address_id)
            ->where('user_id', Auth::id())
            ->first();
        if(!$address){
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy địa chỉ!.'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $address
        ]);
    }
}
