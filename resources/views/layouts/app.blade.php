<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoeLMD</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-dark" href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="150" class="me-2">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="/">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="/products">Sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link" href="/cart">Giỏ hàng</a></li>
                <li class="nav-item"><a class="nav-link" href="/login">Đăng nhập</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Đăng ký</a></li>

            </ul>

            <form class="d-flex" action="/search" method="GET">
                <input class="form-control me-2" type="search" name="q" placeholder="Tìm giày..." aria-label="Search">
                <button class="btn btn-outline-dark" type="submit">Tìm</button>
            </form>
        </div>
    </div>
</nav>


    {{-- Nội dung trang --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer style="text-align: center; padding: 20px; background: #333; color: #fff;">
        &copy; {{ date('Y') }} ShoeLMD - All rights reserved.
    </footer>

</body>
</html>