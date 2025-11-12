<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->merge([
            'quantity' => (int) $request->quantity,
        ]);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->quantity > $product->stock) {
            return response()->json(['message' => 'Số lượng vượt quá tồn kho'], 400);
        }

        // Nếu người dùng đã đăng nhập
        if (Auth::check()) {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->first();

            if ($cartItem) {
                $newQuantity = $cartItem->quantity + $request->quantity;

                if ($newQuantity > $product->stock) {
                    return response()->json(['message' => 'Tổng số lượng vượt quá tồn kho'], 400);
                }

                $cartItem->quantity = $newQuantity;
                $cartItem->save();
            } else {
                CartItem::create([
                    'user_id'    => Auth::id(),
                    'product_id' => $request->product_id,
                    'quantity'   => $request->quantity,
                ]);
            }

            $cartCount = CartItem::where('user_id', Auth::id())->count();
        }

        // Nếu người dùng chưa đăng nhập → lưu session
        else {
            $cart = session()->get('cart', []);

            if (isset($cart[$request->product_id])) {
                $newQuantity = $cart[$request->product_id]['quantity'] + $request->quantity;

                if ($newQuantity > $product->stock) {
                    return response()->json(['message' => 'Tổng số lượng vượt quá tồn kho'], 400);
                }

                $cart[$request->product_id]['quantity'] = $newQuantity;
            } else {
                $cart[$request->product_id] = [
                    'product_id' => $request->product_id,
                    'name'       => $product->name,
                    'price'      => $product->price,
                    'quantity'   => $request->quantity,
                    'stock'      => $product->stock,
                    'image'      => $product->images->first()->image ?? 'uploads/products/default-product.png',
                ];
            }

            session()->put('cart', $cart);
            $cartCount = count($cart);
        }

        return response()->json([
            'message'    => 'Đã thêm sản phẩm vào giỏ hàng thành công',
            'cart_count' => $cartCount,
        ], 200);
    }

    public function loadMiniCart()
    {
        if (Auth::check()) {
            $cartItems = \App\Models\CartItem::with('product')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            $cartItems = collect(session('cart', [])); // dùng collection để dễ count()
        }

        $html = view('clients.components.include.mini-cart', compact('cartItems'))->render();

        return response()->json([
            'status' => true,
            'html' => $html,
        ]);
    }

    public function removeFromMiniCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
        ]);

        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->delete();
            $cartItems = CartItem::where('user_id', Auth::id())->get();
            $cartCount = $cartItems->count();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
            $cartItems = $cart;
            $cartCount = count($cart);
        }

        return response()->json([
            'status' => true,
            'message' => 'Đã xóa sản phẩm khỏi giỏ hàng thành công',
            'cart_count' => $cartCount,
        ]);
    }

    public function viewCart()
    {
        if (Auth::check()) {
            // get cart items from database for authenticated user
            $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get()->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'name'       => $item->product->name,
                    'price'      => $item->product->price,
                    'quantity'   => $item->quantity,
                    'stock'      => $item->product->stock,
                    'image'      => $item->product->images->first()->image ?? 'uploads/products/default-product.png',
                ];
            })->toArray();
        } else {
            // get cart items from session for guest user
            $cartItems = session()->get('cart', []);
        }
        return view('clients.pages.cart', compact('cartItems'));
    }

    // Other cart-related methods (update quantity, clear cart, etc.) can be added here
    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Nếu người dùng đã đăng nhập
        if (Auth::check()) {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity = $request->quantity;
                $cartItem->save();
            } else {
                return response()->json(['message' => 'Sản phẩm không có trong giỏ hàng'], 404);
            }
            // Khi vượt quá số lượng tồn kho
            if ($request->quantity > $product->stock) {
                return response()->json(['message' => 'Số lượng vượt quá tồn kho'], 400);
            }
        } else { // Nếu người dùng chưa đăng nhập → lưu session
            $cart = session()->get('cart', []);

            if (isset($cart[$request->product_id])) {
                $cart[$request->product_id]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
            } else {
                return response()->json(['message' => 'Sản phẩm không có trong giỏ hàng'], 404);
            }
            // Khi vượt quá số lượng tồn kho
            if ($request->quantity > $product->stock) {
                return response()->json(['message' => 'Số lượng vượt quá tồn kho'], 400);
            }
        }
        // Caculate total price
        $subtotal = $product->price * $request->quantity;
        $total = $this->calculateTotal();
        
        $grandTotal = $total + 25000; // Add any additional fees if necessary

        $subtotal = number_format($subtotal, 0, ',', '.');
        $total = number_format($total, 0, ',', '.');
        $grandTotal = number_format($grandTotal, 0, ',', '.');

        return response()->json([
            'status' => true,
            'quantity' => $request->quantity,
            'item_total' => $subtotal,
            'cart_total' => $total,
            'grand_total' => $grandTotal,
            'cart_count' => Auth::check()
                ? CartItem::where('user_id', Auth::id())->count()
                : count(session('cart', [])),
            'message' => 'Cập nhật giỏ hàng thành công'
        ]);
    }

    // calaculate total price helper function
    public function calculateTotal()
    {
        if (Auth::check()) {
            $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
            $total = $cartItems->reduce(function ($carry, $item) {
                return $carry + ($item->product->price * $item->quantity);
            }, 0);
        } else {
            $cartItems = session()->get('cart', []);
            $total = collect($cartItems)->reduce(function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);
        }
        return $total;
    }

    // Remove item from cart
    public function removeCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->delete();
            $cartItems = CartItem::where('user_id', Auth::id())->get();
            $cartCount = $cartItems->count();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
            $cartItems = $cart;
            $cartCount = count($cart);
        }
        // Caculate total price
        $total = $this->calculateTotal();
        $grandTotal = $total + 25000; // Add any additional fees if necessary
        return response()->json([
            'status' => true,
            'message' => 'Đã xóa sản phẩm khỏi giỏ hàng thành công',
            'cart_count' => $cartCount,
            'cart_total' => $total,
            'grand_total' => $grandTotal,
        ]);
    }
}
