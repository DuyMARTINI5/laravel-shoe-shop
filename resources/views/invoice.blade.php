@extends('layout')

@section('content')
<div class="container my-5">
    <h2>Hóa đơn #{{ $order->id }}</h2>
    <p><strong>Tên khách hàng:</strong> {{ $order->customer_name }}</p>
    <p><strong>SĐT:</strong> {{ $order->customer_phone }}</p>
    <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
    <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Phương thức thanh toán:</strong> 
        @switch($order->payment_method)
            @case('cod')
                Thanh toán khi nhận hàng (COD)
                @break
            @case('bank_transfer')
                Chuyển khoản ngân hàng
                @break
            @case('paypal')
                Thanh toán qua PayPal
                @break
            @case('momo')
                Thanh toán qua Momo
                @break
            @case('zalopay')
                Thanh toán qua ZaloPay
                @break
            @default
                Không xác định
        @endswitch
    </p>

    <table class="table table-bordered mt-4">
        <thead class="table-light">
            <tr>
                <th>Tên sản phẩm</th>
                <th class="text-center">Số lượng</th>
                <th class="text-end">Đơn giá</th>
                <th class="text-end">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @if ($order->cart && is_array(json_decode($order->cart, true)))
                @foreach (json_decode($order->cart, true) as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td class="text-center">{{ $item['quantity'] }}</td>
                        <td class="text-end">{{ number_format($item['price'], 0, ',', '.') }} đ</td>
                        <td class="text-end">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} đ</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center text-danger">Không có sản phẩm nào trong giỏ hàng.</td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                <td class="text-end text-danger fw-bold">{{ number_format($order->total, 0, ',', '.') }} đ</td>
            </tr>
        </tfoot>
    </table>

    <div class="text-center mt-4">
        <a href="/" class="btn btn-primary">🏠 Về trang chủ</a>
    </div>
</div>
@endsection

