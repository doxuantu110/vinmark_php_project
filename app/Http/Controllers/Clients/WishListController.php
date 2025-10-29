<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Wishlist;

class WishListController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->get();
        return view('clients.pages.wishlist', compact('wishlists'));
    }

    public function addToWishList(Request $request)
    {
        $user_id = Auth::id();
        $product_id = $request->product_id;

        WishList::create([
            'user_id' => $user_id,
            'product_id' => $product_id
        ]);
        return response()->json([
            'status' => true,
        ], 200);
    }

    public function removeWishListItem(Request $request){
        WishList::where('user_id', Auth::id())->where('product_id', $request->product_id)->delete();

        return response()->json([
            'status' => true,
        ], 200);
    }
}
