<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MergeCartAfterLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        $sessionCart = session()->get('cart', []);

        if(!empty($sessionCart)) {
            foreach ($sessionCart as $productId => $item) {
                $existingCartItem = \App\Models\CartItem::where('user_id', $user->id)
                    ->where('product_id', $productId)
                    ->first();

                if($existingCartItem) {
                    $existingCartItem->quantity += $item['quantity'];
                    $existingCartItem->save();
                }else{
                    \App\Models\CartItem::create([
                        'user_id' => $user->id,
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                    ]);
                }
            }
            // Xóa giỏ hàng trong session sau khi hợp nhất
            session()->forget('cart');
        }
    }
}
