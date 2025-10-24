<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $addresses = ShippingAddress::where('user_id', $user->id)->get();
        $defaultAddress = $addresses->where('default', true)->first();
        if (is_null($defaultAddress) || is_null($addresses)) {
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
    public function getAddress(Request $request)
    {
        $address = ShippingAddress::where('id', $request->address_id)
            ->where('user_id', Auth::id())
            ->first();
        if (!$address) {
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

    public function placeOrder(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:shipping_addresses,id',
            'payment_method' => 'required|in:cash,paypal'
        ]);
        // validate cart not empty
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            toastr()->error('Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi thanh toán.');
            return redirect()->route('cart');
        }
        DB::beginTransaction();
        try {
            // create order
            $order = new Order();
            $order->user_id = $user->id;
            $order->shipping_address_id = $request->address_id;
            $order->total_price = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
            $order->status = 'pending';
            $order->save();

            // create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // create payment
            Payment::create([
                'order_id' => $order->id,
                'amount' => $order->total_price,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
                'paid_at' => null,
            ]);

            // delete products in cart when order success
            CartItem::where('user_id', $user->id)->delete();
            DB::commit();
            toastr()->success('Đặt hàng thành công!');
            return redirect()->route('account');
        } catch (\Exception $e) {
            Log::error("Lỗi đặt hàng: " . $e->getMessage());
            DB::rollBack();
            toastr()->error('Đặt hàng thất bại. Vui lòng thử lại sau.' . $e->getMessage());
            return redirect()->route('checkout');
        }
    }
}
