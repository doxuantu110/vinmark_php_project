<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phản hồi liên hệ</title>
    <style>
        /* Thiết lập chung */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            -webkit-text-size-adjust: 100%;
            /* Ngăn iOS tự phóng to chữ */
        }

        /* Container bao ngoài để căn giữa */
        .email-wrapper {
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        /* Khung nội dung chính */
        .email-content {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

            /* Quan trọng: Giới hạn chiều rộng chuẩn email */
            max-width: 600px;
            margin: 0 auto;
            display: block;
        }

        /* Tiêu đề */
        h1 {
            color: #4CAF50;
            margin-top: 0;
            font-size: 24px;
            text-align: center;
            /* Căn giữa tiêu đề cho đẹp */
        }

        /* Nội dung tin nhắn */
        .message {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
            /* Tăng khoảng cách dòng cho dễ đọc */
        }

        /* Responsive cho điện thoại */
        @media only screen and (max-width: 600px) {
            .email-content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <p>Xin chào,</p>

    <p>Cảm ơn bạn đã liên hệ với Vinmark – Cửa hàng thực phẩm sạch.</p>

    <p>Dưới đây là phản hồi của chúng tôi:</p>

    <div style="padding: 10px; border-left: 3px solid #0abf53; margin: 15px 0;">
        {!! $messageContent !!}
    </div>

    <p>Nếu bạn còn thắc mắc nào khác, hãy phản hồi trực tiếp email này.</p>

    <p>
        Trân trọng,<br>
        <strong>Đội ngũ hỗ trợ khách hàng Vinmark</strong>
    </p>

</body>

</html>
