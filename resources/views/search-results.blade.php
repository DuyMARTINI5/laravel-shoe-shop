@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Kết quả tìm kiếm cho: <strong>{{ $query }}</strong></h3>

    @if ($products->isEmpty())
        <div class="alert alert-warning mt-3">Không tìm thấy sản phẩm nào.</div>
    @else
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
