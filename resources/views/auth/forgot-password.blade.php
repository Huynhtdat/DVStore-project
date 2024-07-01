@extends('layouts.user.main-client')

@section('content-client')
<div class="container">
    <div class="col-md-8 offset-md-2">
        <div class="checkout-page">
            <ol class="checkout-steps">
                <li class="steps active">
                    <h4 class="title-steps text-center">Quên Mật Khẩu</h4>
                    <div class="step-description">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="run-customer">
                                    <form action="{{ route('user.forgot_password_create') }}" method="POST" id="login-form__js">
                                        @csrf
                                        @if (Session::has('notify'))
                                        <p class="alert alert-success">{{ session('notify') }}</p>
                                        @endif
                                        <div class="form-group">
                                            <label for="email"><strong>Email đăng kí</strong></label>
                                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Nhập email đăng kí tài khoản">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Quên Mật Khẩu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ol>
            <div class="content-footer text-center mt-3">
                <a href="{{ route('user.login') }}" class="text-primary">Quay lại trang đăng nhập</a>
            </div>
        </div>
    </div>
</div>
@endsection
