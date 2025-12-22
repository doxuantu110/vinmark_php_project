<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        $products = Product::with('firstImage')->where('status', 'in_stock')->paginate(9);

        return view('clients.pages.products', compact('categories', 'products'));
    }
public function filter(Request $request)
{
    $query = Product::with('firstImage')->where('status', 'in_stock');

    // 1. Lọc theo danh mục
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 2. Lọc theo giá
    if ($request->filled('min_price') && $request->filled('max_price')) {
        $query->whereBetween('price', [
            $request->min_price,
            $request->max_price
        ]);
    }

    // 3. Sắp xếp
    match ($request->sort_by) {
        'price_asc'  => $query->orderBy('price', 'asc'),
        'price_desc' => $query->orderBy('price', 'desc'),
        'latest'     => $query->orderBy('created_at', 'desc'),
        default      => $query->orderBy('id', 'desc'), // Mặc định
    };

    // 🔥 FIX: Luôn luôn phân trang, không dùng get()
    $products = $query->paginate(9);

    // Xử lý ảnh (Tốt nhất nên dùng Accessor trong Model, nhưng viết ở đây cũng được)
    foreach ($products as $product) {
        $product->image_url = $product->firstImage
            ? asset('storage/uploads/products/' . $product->firstImage->image)
            : asset('storage/uploads/products/default-product.png');
    }

    // Render view trả về
    return response()->json([
        'products'   => view('clients.components.products_grid', compact('products'))->render(),
        'pagination' => $products->links('clients.components.pagination.pagination_custom')->render()
    ]);
}



    public function detail($slug)
    {
        $product = Product::with(['category', 'images', 'reviews.user'])->where('slug', $slug)->firstOrFail();

        // Get products in the same category
        $relatedProducts = Product::where('category_id', $product->category->id)
            ->where('id', '!=', $product->id)
            ->limit(6)
            ->get();
        $hasPurchased = false;
        $hasReviewed = false;

        // Caculate stars rating
        $averageRating = round($product->reviews()->avg('rating') ?? 0, 1);
        if(Auth::check()){
            $user = Auth::user();

            $hasPurchased = OrderItem::whereHas('order', function($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->where('status', 'completed');
            })->where('product_id', $product->id)->exists();

            $hasReviewed = Review::where('user_id', $user->id)
                            ->where('product_id', $product->id)
                            ->exists();
        }
        return view('clients.pages.product-detail', compact('product', 'relatedProducts', 'hasPurchased', 'hasReviewed', 'averageRating'));
    }
}
