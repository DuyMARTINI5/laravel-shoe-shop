@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<div class="text-white text-center position-relative" style="background-image: url('{{ asset('images/background.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 100vh;">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity: 0.5;"></div>
    <div class="position-relative d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh; z-index: 1;">
        <h1 class="display-4 fw-bold">Chào mừng đến với <span class="text-warning">LMD</span></h1>
        <p class="lead">Khám phá bộ sưu tập giày mới nhất, phong cách và độc đáo</p>
        <a href="/products" class="btn btn-warning btn-lg mt-3">Xem sản phẩm</a>
    </div>
</div>

<!-- Featured Products -->
<section class="container my-5">
    <h2 class="text-center mb-4">🌟 Sản phẩm nổi bật</h2>
    <div class="row g-4">
        @forelse ($featuredProducts as $product)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-danger fw-bold">{{ number_format($product->price, 0, ',', '.') }} đ</p>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark w-100">🛒 Thêm vào giỏ</button>
                    </form>
</div>

                </div>
            </div>
        @empty
            <p class="text-center">Hiện chưa có sản phẩm nổi bật được hiển thị.</p>
        @endforelse
    </div>
</section>

<!-- Footer -->
<footer class="bg-light py-5 mt-5 border-top">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Resources</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Find A Store</a></li>
                    <li><a href="#">Become A Member</a></li>
                    <li><a href="#">Send Us Feedback</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Help</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Get Help</a></li>
                    <li><a href="#">Order Status</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>About Us</h5>
                <ul class="list-unstyled">
                    <li><a href="#">About ShoeWorld</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Careers</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-4 text-muted">
            &copy; {{ date('Y') }} ShoeWorld - All rights reserved.
        </div>
    </div>
</footer>

@endsection
