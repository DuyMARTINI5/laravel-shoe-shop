
@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">📦 Quản lý sản phẩm</h2>

    {{-- Nút thêm sản phẩm --}}
    <div class="mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">➕ Thêm sản phẩm</a>
    </div>

    {{-- Bảng danh sách sản phẩm --}}
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td width="80">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" width="60">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                    <td>{{ $product->category->name ?? 'Không có' }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">✏️ Sửa</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">🗑️ Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Không có sản phẩm nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection