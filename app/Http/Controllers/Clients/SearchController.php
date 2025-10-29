<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
   public function index(Request $request)
{
    // Lấy từ khóa tìm kiếm từ input (tên ô input trong form là 'keyword')
    $keyword = $request->input('keyword');

    // Kiểm tra nếu người dùng chưa nhập từ khóa
    if (!$keyword) {
        return redirect()->back()->with('error', 'Vui lòng nhập từ khóa tìm kiếm.');
    }

    // Tìm sản phẩm có tên hoặc mô tả chứa từ khóa
    $products = Product::where('name', 'LIKE', "%{$keyword}%")
        ->orWhere('description', 'LIKE', "%{$keyword}%")
        ->paginate(12);

    // Trả về view hiển thị kết quả tìm kiếm, kèm danh sách sản phẩm
    return view('clients.pages.product_search', compact('products'));
}

}
