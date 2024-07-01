@extends('layouts.user.main-client')

@section('content-client')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-white text-dark text-center rounded-top border-bottom">
                    <h2 class="section-title mb-0">Đăng Nhập</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.login') }}" method="POST" id="login-form__js">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email" class="form-label"><strong>Email:</strong></label>
                            <input type="email" class="form-control rounded-2" id="email" name="email" value="{{ old('email') }}" placeholder="Nhập email" required>
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label"><strong>Mật Khẩu:</strong></label>
                            <input type="password" class="form-control rounded-2" id="password" name="password" placeholder="Nhập mật khẩu" required>
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill  px-5"><strong>Đăng Nhập</strong></button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-white rounded-bottom border-top-0">
                    <p class="mb-1 text-center">Hoặc đăng nhập</p>
                    <div class="row justify-content-center">
                        <a href="{{ route('google-auth', 'google') }}" class="btn btn-danger social-btn col-5 mb-2 rounded-pill">
                            <i class="fab fa-google"></i> Sign In with Google
                        </a>
                    </div>
                    <div class="mt-2 text-center">
                        <a href="{{ route('user.forgot_password_create') }}"><strong>Quên mật khẩu?</strong></a>
                    </div>
                    <p class="mt-3 mb-0">Nếu bạn chưa có tài khoản, <a href="{{ route('user.register') }}"><strong>Đăng ký</strong></a> ngay.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@vite('resources/common/js/login.js')
@endpush
