@extends('layouts.app')

@section('content')
<style>
    body {
        background: url("{{ asset('images/login.jpg') }}") no-repeat center center fixed;
        background-size: cover;
    }

    .auth-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 90vh;
    }

    .auth-form {
        background: rgba(255, 255, 255, 0.95);
        padding: 30px;
        border-radius: 10px;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="auth-wrapper">
    <div class="auth-form">
        <h3 class="text-center mb-4">🔐 Đăng nhập</h3>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-dark w-100">Đăng nhập</button>
        </form>

        <p class="text-center mt-3">
            Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a>
        </p>
    </div>
</div>
@endsection
