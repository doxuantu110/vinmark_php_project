<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Hóa đơn mua hàng – VinMark</title>
</head>

<body
    style="font-family: Arial, sans-serif; font-size: 16px; color: #333; line-height: 1.6; margin: 0; padding: 20px; background-color: #f6fff8;">

    <div
        style="max-width: 700px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">

        <p>Xin chào <strong>{{ $order->shippingAddress->full_name }}</strong>,</p>
        <p>Cảm ơn bạn đã tin tưởng lựa chọn <strong>VinMark – Cửa hàng thực phẩm sạch</strong>. Chúng tôi rất vui được
            phục vụ bạn! Dưới đây là thông tin chi tiết đơn hàng của bạn.</p>

        <h2 style="text-align: center; background: #2ecc71; color: #fff; padding: 12px; border-radius: 8px;">
            HÓA ĐƠN MUA HÀNG
        </h2>

        <p style="text-align: right; font-size: 14px; color: #777;">Ngày tạo đơn:
            {{ $order->created_at->format('d/m/Y H:i') }}</p>

        <!-- Thông tin -->
        <table style="width: 100%; margin-bottom: 20px; border-spacing: 0;">
            <tr>
                <td style="vertical-align: top; padding-right: 10px;">
                    <strong style="color: #555;">Từ cửa hàng:</strong>
                    <p style="margin-top: 5px;">
                        <strong>VinMark – Thực phẩm sạch mỗi ngày</strong><br>
                        Linh Trung, Thủ Đức, TP. Hồ Chí Minh<br>
                        Điện thoại: 84 (804) 123-9876<br>
                        Email: vinmark@gmail.com
                    </p>
                </td>

                <td style="vertical-align: top; padding-right: 10px;">
                    <strong style="color: #555;">Giao đến:</strong>
                    <p style="margin-top: 5px;">
                        {{ $order->shippingAddress->full_name }}<br>
                        {{ $order->shippingAddress->address }}<br>
                        {{ $order->shippingAddress->city }}<br>
                        SĐT: {{ $order->shippingAddress->phone }}
                    </p>
                </td>

                <td style="vertical-align: top;">
                    <strong style="color: #555;">Thông tin đơn hàng:</strong>
                    <p style="margin-top: 5px;">
                        <b>Mã đơn:</b> #{{ $order->id }}<br>
                        <b>Email:</b> {{ $order->user->email }}<br>
                        <b>Tài khoản:</b> {{ $order->user->name }}
                    </p>
                </td>
            </tr>
        </table>

        <!-- Chi tiết sản phẩm -->
        <h3 style="margin-bottom: 10px; color: #333; border-bottom: 2px solid #eee; padding-bottom: 5px;">
            Chi tiết sản phẩm
        </h3>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr style="background: #2ecc71; color: #fff;">
                    <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Tên sản phẩm</th>
                    <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Ảnh</th>
                    <th style="padding: 10px; text-align: right; border: 1px solid #ddd;">Giá</th>
                    <th style="padding: 10px; text-align: center; border: 1px solid #ddd;">SL</th>
                    <th style="padding: 10px; text-align: right; border: 1px solid #ddd;">Thành tiền</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $item->product->name }}
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            <img src="{{ $item->product->image_url }}" width="60"
                                style="border-radius: 6px; display: block;">
                        </td>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd;">
                            {{ number_format($item->price, 0, ',', '.') }} đ
                        </td>
                        <td style="padding: 10px; text-align: center; border: 1px solid #ddd;">
                            {{ $item->quantity }}
                        </td>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd;">
                            {{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Thanh toán -->
        <h3 style="margin-top: 20px; color: #333;">Phương thức thanh toán:</h3>

        @php
            $method = $order->payment ? $order->payment->payment_method : 'cash';

            $bgColor = '#27ae60';
            $text = 'Thanh toán khi nhận hàng (COD)';

            if ($method == 'paypal') {
                $bgColor = '#007bff';
                $text = 'Thanh toán qua PayPal';
            } elseif ($method == 'momo') {
                $bgColor = '#a50064';
                $text = 'Thanh toán qua ví MoMo';
            }
        @endphp

        <p
            style="background: {{ $bgColor }}; color: #fff; padding: 10px; text-align: center; border-radius: 6px; font-weight: bold;">
            {{ $text }}
        </p>

        <!-- Tóm tắt -->
        <h3 style="margin-top: 20px; color: #333; border-bottom: 2px solid #eee; padding-bottom: 5px;">
            Tóm tắt thanh toán
        </h3>

        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">Tiền hàng:</td>
                <td style="padding: 10px; text-align: right; border-bottom: 1px solid #eee;">
                    {{ number_format($order->total_price - 25000, 0, ',', '.') }} đ
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">Phí vận chuyển:</td>
                <td style="padding: 10px; text-align: right; border-bottom: 1px solid #eee;">
                    {{ number_format(25000, 0, ',', '.') }} đ
                </td>
            </tr>
            <tr style="background: #2ecc71; color: #fff;">
                <td style="padding: 10px;"><strong>Tổng thanh toán:</strong></td>
                <td style="padding: 10px; text-align: right; font-size: 18px; font-weight: bold;">
                    {{ number_format($order->total_price, 0, ',', '.') }} đ
                </td>
            </tr>
        </table>

        <!-- Ghi chú -->

        <p style="margin-top: 25px; font-size: 14px; color: #555;">
            💡 <strong>Lưu ý bảo quản thực phẩm:</strong><br>
            - Rau củ nên bảo quản trong ngăn mát từ 3 – 7°C<br>
            - Thịt cá nên sử dụng trong 24 giờ hoặc bảo quản đông lạnh<br>
            - Tránh để thực phẩm tiếp xúc ánh nắng trực tiếp
        </p>

        <p
            style="text-align: center; font-size: 14px; color: #777; margin-top: 35px; border-top: 1px solid #eee; padding-top: 20px;">
            Cảm ơn bạn đã chọn VinMark! Nếu cần hỗ trợ, chúng tôi luôn sẵn sàng 24/7 qua hotline hoặc email.
        </p>

    </div>
</body>

</html>
