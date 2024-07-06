@extends('layouts.user.main-client')
@section('content-client')
<div class="container content-page">
    <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-8 offset-md-2">
                <div class="checkout-page">
                    <ol class="checkout-steps">
                        <li class="steps active">
                            <h3 class="title text-center">Đổi Mật Khẩu Mới</h3>
                            <div class="step-description">
                                <div class="row justify-content-center">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="run-customer">
                                            <div id="form-data" hidden data-rules="{{ json_encode($rules) }}" data-messages="{{ json_encode($messages) }}"></div>
                                            <form action="{{ route('user.change_new_password') }}" method="POST" id="form__js">
                                                <input type="text" value="{{ $token }}" hidden name="token">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1"><strong>Mật Khẩu Mới</strong></label>
                                                        <input type="password" class="form-control" value="{{ old('password') }}" id="password" name="password" placeholder="Nhập mật khẩu">
                                                        @if ($errors->get('password'))
                                                            <span id="password-error" class="error invalid-feedback" style="display: block">
                                                            {{ implode(", ",$errors->get('password')) }}
                                                            </span>
                                                        @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1"><strong>Xác Nhận Mật Khẩu Mới</strong></label>
                                                    <input type="password" class="form-control" value="{{ old('password_confirmation') }}" id="password_confirm" name="password_confirm" placeholder="Xác nhận mật khẩu">
                                                    @if ($errors->get('password_confirm'))
                                                        <span id="password_confirm-error" class="error invalid-feedback" style="display: block">
                                                        {{ implode(", ",$errors->get('password_confirm')) }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">
                                                        Đổi Mật Khẩu
                                                    </button>
                                                </div>
                                                <div class="content-footer text-center mt-3">
                                                    <a href="{{ route('user.login') }}">
                                                        Quay lại trang đăng nhập
                                                    </a>
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
@vite(['resources/client/js/register.js'])
@endsection
