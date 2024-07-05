@extends('layouts.user.main-client')

@section('content-client')
<div class="container-fluid content-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="title-steps text-center">
                            @if (Session::has('status') && session('status') == 'verification-success')
                                <p>Xác Thực Tài Khoản Thành Công</p>
                            @elseif(Session::has('status') && session('status') == 'forgot-password-success')
                                <p>Thay Đổi Mật Khẩu Thành Công</p>
                            @endif
                        </h4>
                        <div class="step-description">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="run-customer">
                                        @if (Session::has('status') && session('status') == 'verification-success')
                                            <p class="text-center text-notification">Chúc mừng bạn tài khoản của bạn đã được xác thực thành công</p>
                                        @elseif(Session::has('status') && session('status') == 'forgot-password-success')
                                            <p class="text-center text-notification">Chúc mừng bạn đã thay đổi mật khẩu thành công</p>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('user.login') }}" class="btn btn-success">
                                            Đăng Nhập Ngay
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
