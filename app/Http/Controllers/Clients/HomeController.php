<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();

        foreach ($categories as $index => $category) {
            foreach ($category->products as $product) {
                $product->image_url = $product->firstImage?->image
                    ? asset('storage/uploads/products/' . $product->firstImage->image)
                    : asset('storage/uploads/products/default-product.png');
            }
        }
       $bestSellingProducts = Product::join('order_items', 'products.id', '=', 'order_items.product_id')
                ->select('products.*')
                ->selectRaw('SUM(order_items.quantity) as total_sold')
                ->groupBy(
                    'products.id',
                    'products.name',
                    'products.slug',
                    'products.category_id',
                    'products.description',
                    'products.price',
                    'products.stock',
                    'products.unit',
                    'products.status', 
                    'products.created_at',
                    'products.updated_at'
                )
                ->orderByDesc('total_sold')
                ->limit(10)
                ->get();

        return view('clients.pages.home', compact('categories', 'bestSellingProducts'));
    }
}
