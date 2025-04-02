@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Thông tin giao hàng</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="/checkout" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Họ tên</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ giao hàng</label>
            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
        </div>

        <h5 class="mt-4">Tóm tắt đơn hàng:</h5>
        @php $total = 0; @endphp
        <ul class="list-group mb-3">
            @foreach ($cart as $item)
                @php $itemTotal = $item['price'] * $item['quantity']; $total += $itemTotal; @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $item['name'] }} x {{ $item['quantity'] }}
                    <span>{{ number_format($itemTotal, 0, ',', '.') }} đ</span>
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between fw-bold">
                Tổng cộng:
                <span class="text-danger">{{ number_format($total, 0, ',', '.') }} đ</span>
            </li>
        </ul>

        <button type="submit" class="btn btn-dark w-100">Xác nhận đặt hàng</button>
    </form>
</div>
@endsection