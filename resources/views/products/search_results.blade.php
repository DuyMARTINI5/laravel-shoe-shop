
@extends('layouts.app')

@section('title', 'Kết quả tìm kiếm')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-center">Kết quả tìm kiếm cho: "<strong>{{ $query }}</strong>"</h3>

    @if($products->isEmpty())
        <div class="alert alert-warning text-center">Không tìm thấy sản phẩm nào phù hợp.</div>
    @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <!-- Ảnh sản phẩm -->
                        <div class="card-img-top-wrapper" style="height: 200px; overflow: hidden;">
                            <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="object-fit: cover; width: 100%; height: 100%;">
                        </div>
                        <!-- Thông tin sản phẩm -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate" title="{{ $product->name }}">{{ $product->name }}</h5>
                            <p class="card-text text-danger fw-bold">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-dark btn-sm mt-auto">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection


