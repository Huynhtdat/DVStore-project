@extends('layouts.user.layout')

@section('content')
<div class="container_fullwidth content-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 container-page">
                <div class="checkout-page">
                    <ol class="checkout-steps">
                        <li class="steps active">
                            <h1 class="title-steps text-center">Đăng Nhập</h1>
                            <div class="step-description">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="run-customer">
                                            <form action="{{ route('user.login') }}" method="POST" id="login-form__js">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="email" class="form-label"><strong>Email:</strong></label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Nhập email" required>
                                                    @if ($errors->get('email'))
                                                    <div id="email-error" class="invalid-feedback">
                                                        {{ implode(", ",$errors->get('email')) }}
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="password" class="form-label"><strong>Mật Khẩu:</strong></label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                                                    @if ($errors->get('password'))
                                                    <div id="password-error" class="invalid-feedback">
                                                        {{ implode(", ",$errors->get('password')) }}
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary" style="background-color: #007bff;">Đăng Nhập</button> <br><br>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <p class="mb-0">Hoặc đăng nhập</p>
                                                    <div class="row justify-content-center mt-2">
                                                        <a href="#" class="btn btn-primary social-btn col-5 mx-2">
                                                            <i class="fab fa-facebook-f"></i> Facebook
                                                        </a>
                                                        <a href="{{ route('google-auth', 'google') }}" class="btn btn-danger social-btn col-5 mx-2" style="margin-left: 10px;">
                                                            <i class="fab fa-google"></i> Google
                                                        </a>
                                                    </div><br>
                                                    <div class="mt-3">
                                                        <a href="{{ route('user.forgot_password_create') }}"><strong>Quên mật khẩu?</strong></a>
                                                    </div>
                                                    <p class="mt-3 mb-0">Nếu bạn chưa có tài khoản, <a href="{{ route('user.register') }}"><strong>Đăng ký</strong></a> ngay.</p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@vite('resources/common/js/login.js')
@endpush
