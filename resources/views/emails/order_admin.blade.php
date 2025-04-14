<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng mới</title>
</head>
<body>
    <h1>Thông báo đơn hàng mới</h1>
    <p>Đơn hàng mới vừa được đặt với mã đơn hàng: <strong>#{{ $order->id }}</strong></p>
    <p><strong>Thông tin khách hàng:</strong></p>
    <ul>
        <li>Tên: {{ $order->customer_name }}</li>
        <li>Số điện thoại: {{ $order->customer_phone }}</li>
        <li>Địa chỉ: {{ $order->customer_address }}</li>
    </ul>
    <p>Hóa đơn chi tiết được đính kèm trong email này.</p>
</body>
</html>