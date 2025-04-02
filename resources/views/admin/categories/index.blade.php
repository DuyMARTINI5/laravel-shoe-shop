@extends('layout')

@section('content')
<h2>📂 Danh mục sản phẩm</h2>
<a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">➕ Thêm danh mục</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tên danh mục</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
    @foreach($categories as $cat)
        <tr>
            <td>{{ $cat->name }}</td>
            <td>
                <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-sm btn-primary">✏️</a>
                <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa danh mục này?')">🗑️</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
