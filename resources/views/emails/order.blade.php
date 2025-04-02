<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đơn hàng mới từ LMD</title>
</head>
<body>
    <h2>🎉 Cảm ơn bạn đã đặt hàng tại LMD!</h2>

    <p>Xin chào <strong>{{ $order->customer_name }}</strong>,</p>

    <p>Chúng tôi đã nhận được đơn hàng của bạn với thông tin như sau:</p>

    <ul>
        <li><strong>Mã đơn hàng:</strong> #{{ $order->id }}</li>
        <li><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</li>
        <li><strong>Địa chỉ giao hàng:</strong> {{ $order->customer_address }}</li>
        <li><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</li>
    </ul>

    <h4>Chi tiết đơn hàng:</h4>
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @php $cart = json_decode($order->cart, true); $total = 0; @endphp
            @foreach ($cart as $item)
                @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['price'], 0, ',', '.') }} đ</td>
                    <td>{{ number_format($subtotal, 0, ',', '.') }} đ</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" align="right"><strong>Tổng cộng:</strong></td>
                <td><strong>{{ number_format($total, 0, ',', '.') }} đ</strong></td>
            </tr>
        </tbody>
    </table>

    <p>Chúng tôi sẽ sớm giao hàng đến bạn. Mọi thắc mắc vui lòng liên hệ hotline hoặc email hỗ trợ.</p>

    <p>Trân trọng,<br>LMD</p>
</body>
</html>
