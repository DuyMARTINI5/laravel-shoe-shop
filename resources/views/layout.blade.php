<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Laravel Shoe Shop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="/">👟 Laravel Shoe Shop</a>
        <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
    <li class="nav-item"><a class="nav-link" href="/">Trang chủ</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('cart') }}">Giỏ hàng</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('checkout') }}">Thanh toán</a></li>
    
    @php
        $categories = \App\Models\Category::all();
    @endphp
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Danh mục
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        @foreach($categories as $category)
            <li><a class="dropdown-item" href="{{ route('category.products', $category->id) }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
</li>

    @auth
        <li class="nav-item"><a class="nav-link" href="{{ route('my-orders') }}">Đơn hàng của tôi</a></li>
        @if(Auth::user()->is_admin)
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Quản trị</a></li>
        @endif
        <li class="nav-item"><a class="nav-link text-warning" href="{{ route('logout') }}">Đăng xuất</a></li>
    @else
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Đăng nhập</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Đăng ký</a></li>
    @endauth
</ul>
        </div>
    </nav>

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    <footer class="bg-dark text-white text-center py-3">
        &copy; 2025 - Laravel Shoe Shop Demo
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
