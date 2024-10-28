<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thông báo đặt lại mật khẩu</title>
    <style>
        /* Bạn có thể thêm các style ở đây */
        body {
            font-family: Arial, sans-serif;
        }
        .button {
            background-color: #000; /* Màu nền */
            color: white; /* Màu chữ */
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Thông báo đặt lại mật khẩu</h1>
    <p>Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.</p>
    <p><a href="{{ $resetUrl }}" class="button">Đặt lại mật khẩu</a></p>
    <p>Liên kết đặt lại mật khẩu này sẽ hết hạn sau {{ $expire }} phút.</p>
    <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
    <p>Trân trọng, Đội ngũ hỗ trợ</p>
</body>
</html>
