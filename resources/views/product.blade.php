@extends('layout')

@section('title', $product->name)

@section('content')
    <h2>{{ $product->name }}</h2>
    <p>Giá: {{ number_format($product->price) }} VND</p>
    <p>{{ $product->description }}</p>

    @if($product->image)
        <img src="/images/{{ $product->image }}" width="300">
    @endif

    <form action="{{ url('/add-to-cart/' . $product->id) }}" method="POST" style="margin-top: 20px;">
        @csrf
        <button type="submit">🛒 Thêm vào giỏ hàng</button>
    </form>

    <p><a href="/">← Quay về trang chủ</a></p>
@endsection
