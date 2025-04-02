@extends('layouts.admin')

@section('content')
<style>
    .bg-custom-banner {
        background-image: url('{{ asset('images/background.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        padding: 60px 30px;
        border-radius: 10px;
        margin-bottom: 30px;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.8);
    }
</style>

<div class="container py-4">
    <div class="bg-custom-banner">
        <h2 class="mb-0">📦 Danh sách sản phẩm</h2>
        <p>Quản lý, chỉnh sửa và cập nhật sản phẩm tại đây.</p>
    </div>

    {{-- ✅ BUTTON EXPORT CSV & EXCEL --}}
    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('admin.products.export.csv') }}" class="btn btn-sm btn-success">📥 Export CSV</a>
        <a href="{{ route('admin.products.export.excel') }}" class="btn btn-sm btn-warning">📊 Export Excel</a>
    </div>

    {{-- BỘ LỌC DANH MỤC --}}
    <form method="GET" action="{{ route('admin.products.index') }}" class="row g-3 mb-3">
        <div class="col-md-4">
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="">-- Tất cả danh mục --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    {{-- HIỂN THỊ THÔNG BÁO THÀNH CÔNG --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- BẢNG SẢN PHẨM --}}
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td width="80">
                        <img src="{{ asset('images/' . $product->image) }}" width="60" class="rounded">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                    <td>{{ $product->category->name ?? 'Không có' }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa sản phẩm này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Không có sản phẩm.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection