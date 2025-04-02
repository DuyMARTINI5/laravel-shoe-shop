@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Giỏ hàng của bạn</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (count($cart) > 0)
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Ảnh</th>
                    <th>Sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($cart as $id => $item)
                    @php $itemTotal = $item['price'] * $item['quantity']; $total += $itemTotal; @endphp
                    <tr>
                        <td width="80">
                            <img src="{{ asset('images/' . $item['image']) }}" width="70" class="rounded">
                        </td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ number_format($item['price'], 0, ',', '.') }} đ</td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm w-50">
                                <button type="submit" class="btn btn-sm btn-outline-success ms-2">Cập nhật</button>
                            </form>
                        </td>
                        <td>{{ number_format($itemTotal, 0, ',', '.') }} đ</td>
                        <td>
                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-outline-danger">Xóa</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                    <td class="fw-bold text-danger">{{ number_format($total, 0, ',', '.') }} đ</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="text-end">
            <a href="/checkout" class="btn btn-dark">Tiến hành thanh toán</a>
        </div>
    @else
        <p>Giỏ hàng của bạn đang trống.</p>
    @endif
</div>
@endsection
