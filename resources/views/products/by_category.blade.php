@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Danh mục: <strong>{{ $category->name }}</strong></h3>

    @if($products->isEmpty())
        <div class="alert alert-warning text-center">Không có sản phẩm nào trong danh mục này.</div>
    @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="text-danger fw-bold">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary mt-auto">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection