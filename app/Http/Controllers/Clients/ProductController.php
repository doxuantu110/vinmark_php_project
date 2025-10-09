<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function index(){
        $categories = Category::with('products')->get();
        $products = Product::with('firstImage')->where('status', 'in_stock')->paginate(9);

     foreach ($products as $product) {
                $product->image_url = $product->firstImage?->image
                    ? asset('storage/uploads/products/' . $product->firstImage->image)
                    : asset('storage/uploads/products/default-product.png');
        }
            
        return view('clients.pages.products', compact('categories', 'products'));
    }

    public function filter(Request $request){
        $query = Product::query();

        // --- Filter Category nếu có ---
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // --- Filter Price nếu có ---
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        // --- Filter SortBy nếu có ---
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('id', 'desc');
                    break;
            }
        } else {
            // Mặc định sắp xếp theo id giảm dần
            $query->orderBy('id', 'desc');
        }

        // --- Phân trang ---
        $products = $query->paginate(9);

        // load ảnh
        foreach ($products as $product) {
                $product->image_url = $product->firstImage?->image
                    ? asset('storage/uploads/products/' . $product->firstImage->image)
                    : asset('storage/uploads/products/default-product.png');
        }

        // --- Trả về JSON chứa HTML render ---
        return response()->json([
            'products' => view('clients.components.products_grid', compact('products'))->render(),
        ]);
    }
}
