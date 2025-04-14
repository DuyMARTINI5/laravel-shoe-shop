@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Quản lý đơn hàng</h2>

    @if (count($orders) > 0)
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>
                            {{ $order->customer_name }}<br>
                            {{ $order->customer_phone }}<br>
                            <small>{{ $order->customer_address }}</small>
                        </td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-danger">{{ number_format($order->total, 0, ',', '.') }} đ</td>
                        <td><span class="badge bg-success">Đã đặt</span></td>
                        <td>
                            <a href="{{ route('admin.order.invoice', $order->id) }}" class="btn btn-sm btn-outline-primary">In hóa đơn</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Chưa có đơn hàng nào.</p>
    @endif
</div>
@endsection