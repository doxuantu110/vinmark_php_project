<?php

namespace App\Http\Controllers;

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

}
