@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h2>🎉 Đặt hàng thành công!</h2>
    <p>Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi. Chúng tôi sẽ liên hệ với bạn để xác nhận và giao hàng sớm nhất.</p>
    <a href="{{ route('home') }}" class="btn btn-primary mt-4">🏠 Về trang chủ</a>
</div>
@endsection