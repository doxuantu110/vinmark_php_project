<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function showFormAddCategory(Request $request)
    {
        return view('admin.pages.categories-add');
    }

    public function addCategory(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle image upload
        $imagePath = null;

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $imagePath = $file->storeAs('uploads/categories', $fileName, 'public');
        }

        // Create Category
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('admin.categories.add')
            ->with('success', 'Danh mục đã được thêm thành công!');
    }
    public function index()
    {
        $categories = Category::all();
        return view('admin.pages.categories', compact('categories'));
    }

    public function updateCategory(Request $request)
{
    // 1. Sửa rule validate cho khớp với name trong FormData của jQuery
    $request->validate([
        'category_id'   => 'required|exists:categories,id',
        'category_name' => 'required|string|max:255',
        'category_description' => 'nullable|string',
        'category_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
    ]);

    // Lấy danh mục dựa trên category_id
    $category = Category::find($request->category_id);

    // 2. Xử lý ảnh: Xóa ảnh cũ nếu có ảnh mới
    if ($request->hasFile('category_image')) {
        // Xóa ảnh cũ nếu tồn tại
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        // Upload ảnh mới
        $file = $request->file('category_image');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $imagePath = $file->storeAs('uploads/categories', $fileName, 'public');
        
        $category->image = $imagePath;
    }

    // Cập nhật thông tin
    $category->name = $request->category_name;
    
    // Cập nhật slug (nếu muốn slug thay đổi theo tên mới)
    $category->slug = Str::slug($request->category_name);
    
    // Nếu ajax có gửi description thì cập nhật (nếu trong JS bạn đã bổ sung append description)
    if ($request->has('category_description')) {
        $category->description = $request->category_description;
    }

    $category->save();

    // 3. Trả về 'status' thay vì 'success' để khớp với if(response.status) bên JS
    return response()->json([
        'status' => true, 
        'message' => 'Danh mục đã được cập nhật thành công!'
    ]);
}
    // Delete category
    public function deleteCategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        $category = Category::find($request->category_id);

        // Xóa ảnh nếu có
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Danh mục đã được xóa thành công!'
        ]);
    }
}   
