@extends('layout')

@section('title', 'Danh mục: ' . $category->name)

@section('content')
    <h2>📂 Sản phẩm thuộc danh mục: {{ $category->name }}</h2>

    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($product->image)
                        <img src="/images/{{ $product->image }}" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <h5>{{ $product->name }}</h5>
                        <p>{{ $product->description }}</p>
                        <p class="fw-bold">{{ number_format($product->price) }} VND</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @empty
            <p>Chưa có sản phẩm nào trong danh mục này.</p>
        @endforelse
    </div>
@endsection
