@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Đơn hàng của bạn</h2>

    @if (count($orders) > 0)
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Mã đơn</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-danger">{{ number_format($order->total, 0, ',', '.') }} đ</td>
                        <td>Đã đặt</td>
                        <td>
                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="collapse" data-bs-target="#order{{ $order->id }}">Xem</button>
                        </td>
                    </tr>
                    <tr class="collapse" id="order{{ $order->id }}">
                        <td colspan="5">
                            @php $cart = json_decode($order->cart, true); @endphp
                            <ul class="list-group">
                                @foreach ($cart as $item)
                                    <li class="list-group-item d-flex justify-content-between">
                                        {{ $item['name'] }} x {{ $item['quantity'] }}
                                        <span>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} đ</span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Bạn chưa có đơn hàng nào.</p>
    @endif
</div>
@endsection