@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('images/' . $product->image) }}" class="img-fluid rounded shadow" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <p class="text-danger h4">{{ number_format($product->price, 0, ',', '.') }} đ</p>
            <p class="text-muted mt-3">Mô tả sản phẩm sẽ được thêm ở đây sau (nếu có).</p>

            <form action="/cart/add" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-dark btn-lg mt-4">Thêm vào giỏ hàng</button>
            </form>
        </div>
    </div>
</div>
@endsection
