<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
     public function index(Product $product)
    {
        return view('clients/components/include.review-list', compact('product'))->render();
    }
    public function createReview(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Create a new review
        $review = new Review();
        $review->product_id = $request->product_id;
        $review->user_id = Auth::id();
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Đánh giá sản phẩm đã được gửi.'
        ], 200);
    }

}
