@extends('layouts.client')

@section('title', 'Chi tiết đặt hàng')
@section('breadcrumb', 'Chi tiết đặt hàng')
@section('content')

    <div class="liton__shopping-cart-area mb-120">
        <div class="container mt-4">
            <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>
            <p>Ngày đặt: {{ $order->created_at->format('d/m/y') }}</p>
            <p>Trạng thái:
                @if ($order->status == 'pending')
                    <span class="badge bg-warning">Chờ xác nhận</span>
                @elseif($order->status == 'processing')
                    <span class="badge bg-info">Đang xử lý</span>
                @elseif($order->status == 'completed')
                    <span class="badge bg-success">Hoàn thành</span>
                @elseif($order->status == 'canceled')
                    <span class="badge bg-danger">Đã hủy</span>
                @endif
            </p>
            <p>Phương thức thanh toán:
                @if ($order->payment && $order->payment->payment_method == 'cash')
                    <span class="badge bg-primary">Thanh toán khi nhận hàng</span>
                @elseif($order->payment && $order->payment->payment_method == 'momo')
                    <span class="badge bg-primary">Thanh toán bằng momo</span>
                @elseif($order->payment && $order->payment->payment_method == 'paypal')
                    <span class="badge bg-primary">Thanh toán bằng paypal</span>
                @endif

            </p>
            <p>Tổng tiền:
                {{ number_format($order->total_price, 0, ',', '.') }} đ
            </p>
            <h4 class="mt-4">Sản phẩm trong đơn hàng</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>
                                <img src="{{ asset($item->product->image_url) }}" alt="Product Image" width="50">
                            </td>
                            <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
                            </td>
                        </tr>
                        <!-- End loop -->
                    @endforeach
            </table>
            <h4 class="mt-4">Thông tin giao hàng</h4>
            <p>Người nhận: {{ $order->shippingAddress->full_name }}</p>
            <p>Địa chỉ: {{ $order->shippingAddress->address }}</p>
            <p>Thành phố: {{ $order->shippingAddress->city }}</p>
            <p>Số điện thoại: {{ $order->shippingAddress->phone }}</p>

            @if ($order->status == 'pending')
                <form action="{{ route('order.cancel', $order->id) }}" method="POST"
                    onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này không?');">
                    @csrf
                    <button type="submit" class="btn btn-danger mt-3">Hủy đơn hàng</button>
                </form>
            @endif
            @if ($order->status == 'completed')
                <h4 class="mt-4">Đánh giá sản phẩm</h4>
                <table class="table">
                    <thead>
                        <th>Sản phẩm</th>
                        <th>Đánh giá</th>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>
                                    <a href="{{ route('product.detail', $item->product->slug) }}"
                                        class="btn btn-primary">Đánh giá</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection
