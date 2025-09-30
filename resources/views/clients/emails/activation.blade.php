<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Chào mừng {{ $user->name }} đến với Vinmark</h1>
    <p>Cảm ơn bạn đã đăng ký tài khoản. Vui lòng nhấp vào liên kết dưới đây để kích hoạt tài khoản của bạn:</p>
    <a href="{{ route('activateAccount', ['token' => $token]) }}">Kích hoạt tài khoản</a>
    <p>Nếu bạn không đăng ký tài khoản, vui lòng bỏ qua email này.</p>
    <p>Trân trọng,<br>Đội ngũ Vinmark</p>
</body>
</html>