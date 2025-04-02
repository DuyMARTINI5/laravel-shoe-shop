@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Tất cả sản phẩm</h2>
    <div class="row">
        @forelse ($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm d-flex flex-column">
                    <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: contain;">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="text-danger fw-bold mb-2">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-dark btn-sm">Xem chi tiết</a>

                        <form action="{{ url('/add-to-cart/' . $product->id) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary btn-sm w-100">Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Không có sản phẩm nào.</p>
        @endforelse
    </div>
</div>
@endsection
