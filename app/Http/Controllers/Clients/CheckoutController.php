<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

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
                $product = $item->product;
                // decrease product stock
                if ($product->stock < $item->quantity) {
                    throw new \Exception("Sản phẩm {$product->name} không đủ số lượng trong kho.");
                }
                $product->decrement('stock', $item->quantity);
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

    // Handle PayPal order placement
    public function placeOrderPaypal(Request $request)
    {
        $request->validate([
            'orderID' => 'required',
            'payerID' => 'required',
            'transactionID' => 'required',
            'amount' => 'required|numeric',
            'address_id' => 'required|exists:shipping_addresses,id',
            'payment_method' => 'required|string'
        ]);

        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Giỏ hàng trống.']);
        }

        DB::beginTransaction();
        try {
            // Tính tổng giá sản phẩm trong giỏ
            $subtotalUSD = $request->amount;
            $totalPriceVND = $subtotalUSD * 25000 + 25000; // nhân tỷ giá & cộng phí ship

            // Tạo đơn hàng
            $order = Order::create([
                'user_id' => $user->id,
                'shipping_address_id' => $request->address_id,
                'total_price' => $totalPriceVND,
                'status' => 'pending',
            ]);
            
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                $product = $item->product;
                // decrease product stock
                if ($product->stock < $item->quantity) {
                    throw new \Exception("Sản phẩm {$product->name} không đủ số lượng trong kho.");
                }
                $product->decrement('stock', $item->quantity);
            }

            Payment::create([
                'order_id' => $order->id,
                'amount' => $totalPriceVND,
                'payment_method' => 'paypal',
                'status' => 'completed',
                'paid_at' => now(),
                'transaction_id' => $request->transactionID,
            ]);

            CartItem::where('user_id', $user->id)->delete();

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error("Lỗi PayPal: " . $e->getMessage());
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Đặt hàng qua PayPal thất bại.']);
        }
    }

    // Handle Momo order placement
    public function placeOrderMoMo(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'address_id' => 'required|exists:shipping_addresses,id',
        ]);

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo = "Thanh toán qua MoMo";
        $amount = (string)$request->amount;
        $orderId = time() . "";
        $redirectUrl = route('checkout.momoReturn'); // MoMo redirect về
        $ipnUrl = route('checkout.momoNotify');      // MoMo IPN callback
        $extraData = ""; // có thể thêm dữ liệu phụ nếu cần

        $requestId = time() . "";
        $requestType = "payWithATM";
        
        // Chuẩn bị dữ liệu ký
        $rawHash = "accessKey=" . $accessKey .
            "&amount=" . $amount .
            "&extraData=" . $extraData .
            "&ipnUrl=" . $ipnUrl .
            "&orderId=" . $orderId .
            "&orderInfo=" . $orderInfo .
            "&partnerCode=" . $partnerCode .
            "&redirectUrl=" . $redirectUrl .
            "&requestId=" . $requestId .
            "&requestType=" . $requestType;

        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "Vinmark",
            'storeId' => "VinmarkStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];
        session([
            'address_id' => $request->address_id,
            'total_price' => $request->amount
        ]);
        // Gửi request đến MoMo API
        $result = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post($endpoint, $data);

        $jsonResult = $result->json();

        if (isset($jsonResult['payUrl'])) {
            return response()->json(data: ['payUrl' => $jsonResult['payUrl']]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Không thể tạo liên kết thanh toán MoMo.',
                'response' => $jsonResult
            ]);
        }
    }
    public function momoReturn(Request $request)
    {
        if ($request->resultCode == 0) {
            // ✅ Thanh toán thành công

            $user = Auth::user();

            $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();
            $totalPrice = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            // 1️⃣ Tạo Order
            $order = Order::create([
                'user_id' => $user->id,
                'shipping_address_id' => session('address_id'),
                'total_price' => session('total_price'),
                'payment_method' => 'momo',
                'status' => 'pending',
            ]);

            // 2️⃣ Lưu Payment
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'momo',
                'amount' => $order->total_price,
                'paid_at' => now(),
                'status' => 'completed',
                'transaction_id' => $request->transId ?? null,
            ]);

            // 3️⃣ Lưu chi tiết sản phẩm
            $cartItems = CartItem::where('user_id', $user->id)->get();
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
            }

            // 4️⃣ Xóa giỏ hàng
            CartItem::where('user_id', $user->id)->delete();

            // 5️⃣ Thông báo
            toastr()->success('Thanh toán MoMo thành công!');
            return redirect('/account');
        } else {
            toastr()->error('Thanh toán MoMo thất bại hoặc bị hủy.');
            return redirect('/checkout');
        }
    }

    public function momoNotify(Request $request)
    {
        Log::info('MoMo IPN:', $request->all());

        // Tùy chọn: xử lý lưu Order, Payment ở đây khi MoMo báo IPN thành công
        // if ($request->resultCode == 0) { ... }

        return response('OK', 200);
    }
}