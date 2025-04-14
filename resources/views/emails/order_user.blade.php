<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
</head>
<body>
    <h1>Cảm ơn bạn đã đặt hàng tại ShoeWorld!</h1>
    <p>Đơn hàng của bạn đã được xác nhận với mã đơn hàng: <strong>#{{ $order->id }}</strong></p>
    <p><strong>Thông tin khách hàng:</strong></p>
    <ul>
        <li>Tên: {{ $order->customer_name }}</li>
        <li>Số điện thoại: {{ $order->customer_phone }}</li>
        <li>Địa chỉ: {{ $order->customer_address }}</li>
    </ul>
    <p><strong>Chi tiết đơn hàng:</strong></p>
    <ul>
        @foreach (json_decode($order->cart, true) as $item)
            <li>{{ $item['name'] }} - {{ $item['quantity'] }} x {{ number_format($item['price'], 0, ',', '.') }} đ</li>
        @endforeach
    </ul>
    <p><strong>Tổng tiền:</strong> {{ number_format($order->total, 0, ',', '.') }} đ</p>
</body>
</html>