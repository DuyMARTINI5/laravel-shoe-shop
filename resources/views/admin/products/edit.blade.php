
@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">✏️ Chỉnh sửa sản phẩm</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="row g-4">
        @csrf
        @method('PUT')

        <!-- Tên sản phẩm -->
        <div class="col-md-6">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <!-- Giá -->
        <div class="col-md-6">
            <label for="price" class="form-label">Giá</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
        </div>

        <!-- Ảnh hiện tại -->
        <div class="col-md-6">
            <label class="form-label">Ảnh hiện tại</label><br>
            <img src="{{ asset('images/' . $product->image) }}" width="120" class="mb-2">
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <!-- Danh mục -->
        <div class="col-md-6">
            <label for="category_id" class="form-label">Danh mục</label>
            <select name="category_id" id="category_id" class="form-select" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Mô tả -->
        <div class="col-12">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" id="description" rows="4" class="form-control">{{ $product->description }}</textarea>
        </div>

        <!-- Nút cập nhật -->
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary btn-lg">💾 Cập nhật</button>
        </div>
    </form>
</div>
@endsection