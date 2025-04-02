@extends('layout')

@section('content')
<h2>{{ isset($category) ? '✏️ Sửa danh mục' : '➕ Thêm danh mục' }}</h2>
<form method="POST" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}">
    @csrf
    @if(isset($category))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Tên danh mục:</label>
        <input type="text" name="name" class="form-control" value="{{ $category->name ?? '' }}" required>
    </div>

    <button type="submit" class="btn btn-success">💾 Lưu</button>
</form>
@endsection
