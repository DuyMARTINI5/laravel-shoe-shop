@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group mb-4">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action active">Dashboard</a>
                <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action">Quản lý sản phẩm</a>
                <a href="{{ route('admin.products.create') }}" class="list-group-item list-group-item-action">Thêm sản phẩm</a>
                <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action">Đơn hàng</a>
                <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">Danh mục</a>
            </div>
        </div>
        <div class="col-md-9">
            <h2 class="mb-4">Thống kê tổng quan</h2>

            <div class="row text-center mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6>Tổng đơn hàng</h6>
                            <h3>{{ $orders_count }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6>Người dùng</h6>
                            <h3>{{ $users_count }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6>Sản phẩm</h6>
                            <h3>{{ $products_count }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6>Doanh thu</h6>
                            <h3 class="text-danger">{{ number_format($revenue, 0, ',', '.') }} đ</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Biểu đồ doanh thu theo tháng</h5>
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [
                {
                    label: 'Doanh thu (đ)',
                    data: {!! json_encode($chartRevenue) !!},
                    borderColor: '#ff6384',
                    fill: false
                },
                {
                    label: 'Số đơn hàng',
                    data: {!! json_encode($chartOrders) !!},
                    borderColor: '#36a2eb',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection
