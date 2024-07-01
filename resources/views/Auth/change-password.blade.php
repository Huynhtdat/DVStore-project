@extends('layouts.user.main-client')

@section('content-client')
<div class="container">
    <div class="col-md-8 offset-md-2">
        <div class="checkout-page">
            <ol class="checkout-steps">
                <li class="steps active">
                    <h4 class="title-steps text-center">Đổi Mật Khẩu Mới</h4>
                    <div class="step-description">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="run-customer">
                                    <div id="form-data" hidden data-rules="{{ json_encode($rules) }}" data-messages="{{ json_encode($messages) }}"></div>
                                    <form action="{{ route('user.change_new_password') }}" method="POST" id="form__js">
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="password">Mật Khẩu Mới</label>
                                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Nhập mật khẩu mới">
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirm">Xác Nhận Mật Khẩu Mới</label>
                                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" value="{{ old('password_confirm') }}" placeholder="Xác nhận mật khẩu mới">
                                            @error('password_confirm')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Đổi Mật Khẩu</button>
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
