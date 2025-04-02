<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản trị - ShoeLMD</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Responsive chỉnh layout admin */
        @media (max-width: 768px) {
            .list-group {
                margin-bottom: 1rem;
            }

            .table th, .table td {
                font-size: 14px;
            }

            .card .card-body h6 {
                font-size: 14px;
            }

            .card .card-body h3 {
                font-size: 18px;
            }

            .btn-sm {
                padding: 4px 10px;
                font-size: 13px;
            }

            canvas {
                max-width: 100% !important;
                height: auto !important;
            }

            .container, .container-fluid {
                padding-left: 15px;
                padding-right: 15px;
            }
        }
    </style>
</head>
<body>

    {{-- Navbar quản trị --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">LMD Admin</a>
            <div class="d-flex">
                <a href="/" class="btn btn-sm btn-outline-light me-2">🏠 Về trang chính</a>
                <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-warning">Đăng xuất</a>
            </div>
        </div>
    </nav>

    {{-- Nội dung --}}
    <main class="container mt-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center mt-4 text-muted py-3">
        &copy; {{ date('Y') }} LMD Admin Panel
    </footer>

</body>
</html>