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
        <h3 class="text-center mb-4">📝 Đăng ký tài khoản</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Họ tên</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Nhập lại mật khẩu</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
        </form>

        <p class="text-center mt-3">
            Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
        </p>
    </div>
</div>
@endsection
