@extends('layouts.user.layout')

@section('content')
<div class="container_fullwidth content-page">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card rounded-3">
                    <div class="card-header text-center bg-primary text-white rounded-top">
                        <h1 class="title-steps">Đăng Nhập</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.login') }}" method="POST" id="login-form__js">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email" class="form-label"><strong>Email:</strong></label>
                                <input type="email" class="form-control rounded-2" id="email" name="email" value="{{ old('email') }}" placeholder="Nhập email" required>
                                @if ($errors->get('email'))
                                    <div id="email-error" class="invalid-feedback d-block">
                                        {{ implode(", ", $errors->get('email')) }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label"><strong>Mật Khẩu:</strong></label>
                                <input type="password" class="form-control rounded-2" id="password" name="password" placeholder="Nhập mật khẩu" required>
                                @if ($errors->get('password'))
                                    <div id="password-error" class="invalid-feedback d-block">
                                        {{ implode(", ", $errors->get('password')) }}
                                    </div>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-50 rounded-2">Đăng Nhập</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center rounded-bottom">
                        <p class="mb-1">Hoặc đăng nhập</p>
                        <div class="row justify-content-center">
                            <a href="{{ route('google-auth', 'google') }}" class="btn btn-danger social-btn col-5 mb-2 rounded-2">
                                <i class="fab fa-google"></i> Sign In with Google
                            </a>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('user.forgot_password_create') }}"><strong>Quên mật khẩu?</strong></a>
                        </div>
                        <p class="mt-3 mb-0">Nếu bạn chưa có tài khoản, <a href="{{ route('user.register') }}"><strong>Đăng ký</strong></a> ngay.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@vite('resources/common/js/login.js')
@endpush
