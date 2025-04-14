<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ShoeLMD')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-brand img {
            height: 70px;
            transition: transform 0.3s ease-in-out;
        }
        .navbar-brand img:hover {
            transform: scale(1.1);
        }
        .navbar-nav .nav-link {
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s;
        }
        .navbar-nav .nav-link:hover {
            color: #ff5722;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .user-info img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ddd;
        }
        .btn.btn-dark.btn-sm {
            background-color: #ffcc00;
            border-color: #ffcc00;
            color: #000;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }
        .btn.btn-dark.btn-sm:hover {
            background-color: #ffc107;
            transform: scale(1.05);
        }
        main {
            padding-top: 5.5rem;
        }
        .cart-badge {
            background-color: #dc3545;
            color: #fff;
            border-radius: 50%;
            padding: 2px 7px;
            font-size: 12px;
            position: relative;
            top: -10px;
            left: -5px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm fixed-top py-2">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('products') ? 'active' : '' }}" href="/products">Sản phẩm</a></li>
                    <li class="nav-item">
                        <a class="nav-link position-relative {{ request()->is('cart') ? 'active' : '' }}" href="/cart">
                            Giỏ hàng
                            @if (session('cart') && count(session('cart')) > 0)
                                <span class="cart-badge">{{ count(session('cart')) }}</span>
                            @endif
                        </a>
                    </li>
                </ul>

                <form class="d-flex" action="{{ route('products.search') }}" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Tìm sản phẩm..." aria-label="Search" value="{{ request('q') }}">
                    <button class="btn btn-outline-dark" type="submit">Tìm</button>
                </form>

                @auth
                <div class="user-info dropdown">
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar">
                    <a class="dropdown-toggle text-dark text-decoration-none" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="/profile">Hồ sơ</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Đăng xuất
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="/login">Đăng nhập</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="/register">Đăng ký</a></li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="text-center py-3 bg-dark text-white">
        <div class="container">
            <p class="mb-1">&copy; {{ date('Y') }} ShoeLMD - All rights reserved.</p>
            <small>Liên hệ: <a href="mailto:support@shoelmd.com" class="text-white">support@shoelmd.com</a></small>
        </div>
    </footer>
</body>
</html>