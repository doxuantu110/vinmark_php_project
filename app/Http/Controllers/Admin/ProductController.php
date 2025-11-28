<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product; // Make sure to import Product
use App\Models\ProductImage; // Make sure to import ProductImage
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
// Removed redundant use Intervention\Image\Image as InterventionImage;

class ProductController extends Controller
{

    // --- Show Form Method (No changes needed here) ---
    public function showFormAddProduct()
    {
        $categories = Category::all();
        return view('admin.pages.product-add', compact('categories'));
    }

    // --- Add Product Method (Corrections applied) ---
    public function addProduct(Request $request)
    {
        // 1. Validation 
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            // The images.* rule is correct
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = Str::slug($request->name) . '-' . time();

        // 2. Create Product 
        $product = Product::create([ // Use the imported Product model
            'name' => $request->name,
            'slug' => $slug,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'unit' => $request->unit ?? 'kg',
            'stock' => $request->stock ?? 1,
            'status' => 'in_stock',
        ]);

        // 3. Handle image uploads 
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $img = Image::make($image)
                    ->resize(600, 600, function ($c) {
                        $c->aspectRatio();
                        $c->upsize();
                    })
                    ->encode('jpg', 90);

                Storage::disk('public')->put('uploads/products/' . $imageName, $img);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'uploads/products/' . $imageName, // Đường dẫn dùng trong view
                ]);
            }
        }
        return redirect()->route('admin.product.add')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category', 'images')->get();
        return view('admin.pages.products', compact('products', 'categories'));
    }
    // ...

    public function updateProduct(Request $request)
    {
        // 1. Validation
        $request->validate([
            'id'          => 'required|exists:products,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'unit'        => 'required|string|max:50',
            'status'      => 'required|in:in_stock,out_stock',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
        ]);

        // 2. Tìm sản phẩm
        $product = Product::find($request->id);
        if (!$product) {
            return response()->json(['status' => false, 'message' => 'Không tìm thấy sản phẩm.'], 404);
        }

        // 3. Cập nhật thông tin
        $product->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'unit'        => $request->unit,
            'status'      => $request->status,
            'category_id' => $request->category_id,
        ]);

        // 4. Xử lý ảnh mới (thay thế ảnh cũ)
        if ($request->hasFile('images')) {

            // 4.1. Xóa ảnh cũ từ storage và DB
            foreach ($product->images as $img) {
                if (Storage::disk('public')->exists($img->image)) {
                    Storage::disk('public')->delete($img->image);
                }
                $img->delete();
            }

            // 4.2. Thêm ảnh mới
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $path,
                ]);
            }
        }

        // 5. Trả kết quả
        return response()->json(['status' => true, 'message' => 'Cập nhật sản phẩm thành công!']);
    }

    // --- Delete Product Method (Newly Added) ---
    public function deleteProduct(Request $request)
    {
        // 1. Validation
        $request->validate([
            'id' => 'required|exists:products,id',
        ], [
            'id.exists' => 'Sản phẩm không tồn tại.',
        ]);
        // 2. Tìm sản phẩm
        $product = Product::find($request->id);
        if (!$product) {
            return response()->json(['status' => false, 'message' => 'Không tìm thấy sản phẩm.'], 404);
        }   
        // 3. Xóa ảnh khỏi storage và DB
        foreach ($product->images as $img) {
            if (Storage::disk('public')->exists($img->image)) {
                Storage::disk('public')->delete($img->image);  
            }
            $img->delete();
        }
        // 4. Xóa sản phẩm
        $product->delete();
        // 5. Trả kết quả
        return response()->json(['status' => true, 'message' => 'Xóa sản phẩm thành công!']);
    }
}
