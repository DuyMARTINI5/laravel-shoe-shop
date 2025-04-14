@extends('layout')
@section('content')
<div class="container mt-5">
    <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>

    <div class="card p-4 mb-4">
        <h5>Thông tin khách hàng</h5>
        <ul>
            <li><strong>Tên:</strong> {{ $order->customer_name }}</li>
            <li><strong>Điện thoại:</strong> {{ $order->customer_phone }}</li>
            <li><strong>Địa chỉ:</strong> {{ $order->customer_address }}</li>
        </ul>
    </div>

    <div class="card p-4 mb-4">
        <h5>Sản phẩm đã đặt</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach(json_decode($order->cart, true) as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['price']) }} VND</td>
                        <td>{{ number_format($item['price'] * $item['quantity']) }} VND</td>
                    </tr>
                    @php $total += $item['price'] * $item['quantity']; @endphp
                @endforeach
            </tbody>
        </table>
        <div class="text-end">
            <strong>Tổng cộng: {{ number_format($total) }} VND</strong>
        </div>
    </div>

    <a href="{{ url('/products') }}" class="btn btn-secondary">Quay lại mua sắm</a>
</div>
@endsection
