<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems', 'shippingAddress', 'user', 'payment')->orderByDesc('id')->get();
        // Logic to retrieve and display orders
        return view('admin.pages.orders', compact('orders'));
    }

    public function confirm(Request $request)
    {
        $order = Order::find($request->id);

        if ($order) {
            $order->status = 'processing';
            $order->save();

            return response()->json([
                'message' => 'Xác nhận đơn hàng thành công',
                'status'  => true
            ]);
        }

        return response()->json([
            'message' => 'Đơn hàng không tồn tại',
            'status'  => false
        ]);
    }
    public function showOrderDetail($id)
    {
        $order = Order::with('orderItems.product', 'shippingAddress', 'user', 'payment')->find($id);

        return view('admin.pages.order-detail', compact('order'));
    }

    public function sendInvoice(Request $request)
    {
        $id = $request->id;

        // Tải đơn hàng cùng đầy đủ quan hệ
        $order = Order::with('orderItems.product', 'shippingAddress', 'user', 'payment')->find($id);

        // Kiểm tra đơn hàng
        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy đơn hàng. Vui lòng kiểm tra lại!',
            ]);
        }

        // Kiểm tra email khách hàng
        if (!$order->user || !$order->user->email) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể gửi hóa đơn vì thiếu email khách hàng!',
            ]);
        }

        // Kiểm tra thông tin giao hàng
        if (!$order->shippingAddress) {
            return response()->json([
                'status' => false,
                'message' => 'Đơn hàng chưa có thông tin giao hàng, không thể gửi hóa đơn!',
            ]);
        }

        try {
            // Gửi hóa đơn qua email
            Mail::send('admin.emails.invoice', compact('order'), function ($message) use ($order) {
                $message->to($order->user->email)
                    ->subject('Hóa đơn đơn hàng Vinmark – Thực phẩm sạch giao tận nhà');
            });

            return response()->json([
                'status' => true,
                'message' => 'Hóa đơn đã được gửi thành công đến email khách hàng!',
            ]);
        } catch (\Throwable $th) {
            // Bạn có thể dùng Log::error() nếu muốn
            // Log::error("Lỗi gửi hóa đơn: " . $th->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Hệ thống gặp lỗi khi gửi hóa đơn. Vui lòng thử lại sau!',
                // 'debug' => $th->getMessage() // bật khi debug
            ]);
        }
    }

    public function cancelOrder(Request $request)
    {
        // 1. Lấy Order ID từ request gửi lên
        $id = $request->id;

        // 2. Tìm kiếm đơn hàng trong cơ sở dữ liệu dựa trên ID
        $order = Order::find($id);

        // 3. Kiểm tra xem đơn hàng có tồn tại hay không
        if ($order) {
            // Lặp qua tất cả các mặt hàng trong đơn hàng để hoàn trả số lượng vào kho
            foreach ($order->orderItems as $item) {
                // Update product stock
                // Tăng số lượng (stock) của sản phẩm lên bằng số lượng (quantity) đã đặt
                $item->product->increment('stock', $item->quantity);
            }

            // Cập nhật trạng thái đơn hàng thành 'canceled' (đã hủy)
            $order->status = 'cancelled';

            // Lưu lại thay đổi vào cơ sở dữ liệu
            $order->save();

            // Trả về phản hồi JSON báo hủy thành công
            return response()->json([
                'status' => true,
                'message' => 'Đơn hàng đã được hủy thành công!',
            ]);
        }

        // Nếu đơn hàng không tồn tại, trả về phản hồi JSON báo lỗi
        return response()->json([
            'status' => false,
            'message' => 'Đơn hàng không tồn tại!',
        ]);
    }
}
