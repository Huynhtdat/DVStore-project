@extends('layouts.user.main-client')

@section('content-client')
    <style>
            .input-group-text {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: .375rem .75rem;
                margin-bottom: 0;
                font-size: 1rem;
                font-weight: 400;
                height: 45px;
                line-height: 3;
                color: #495057;
                text-align: center;
                white-space: nowrap;
                background-color: #fff;
                border: 1px solid #ced4da;
                border-left: none;
                border-radius: 0 .25rem .25rem 0;
            }
            .input-group-text i {
                color: #888;
            }
            .input-group-text:hover i {
                color: #000;
            }
        </style>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-white text-dark text-center rounded-top border-bottom">
                    <h2 class="section-title mb-0">Đăng Ký Tài Khoản</h2>
                </div>
                <div class="card-body">
                    <div id="form-data" hidden data-rules="{{ json_encode($rules) }}"data-messages="{{ json_encode($messages) }}"></div>
                    <form action="{{ route('user.register') }}" method="POST" id="register-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                    <label for="exampleInputEmail1"><strong>Họ Và Tên</strong></label>
                                    <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" aria-describedby="emailHelp" placeholder="Nhập họ và tên">
                                    @if ($errors->get('name'))
                                        <span id="name-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ",$errors->get('name')) }}
                                        </span>
                                    @endif
                                    </div>
                                    <div class="form-group mb-3">
                                    <label for="exampleInputEmail1"><strong>Email</strong></label>
                                    <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" aria-describedby="emailHelp" placeholder="Nhập email">
                                    @if ($errors->get('email'))
                                        <span id="email-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ",$errors->get('email')) }}
                                        </span>
                                    @endif
                                    </div>
                                    <div class="form-group mb-3">
                                    <label for="exampleInputPassword1"><strong>Mật Khẩu</strong></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" value="{{ old('password') }}" id="password" name="password" placeholder="Nhập mật khẩu">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @if ($errors->get('password'))
                                        <span id="password-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ",$errors->get('password')) }}
                                        </span>
                                    @endif
                                    </div>
                                    <div class="form-group mb-3">
                                    <label for="exampleInputPassword1"><strong>Xác Nhận Mật Khẩu</strong></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" value="{{ old('password_confirmation') }}" id="password_confirm" name="password_confirm" placeholder="Xác nhận mật khẩu">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="togglePasswordConfirm" style="cursor: pointer;">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @if ($errors->get('password_confirm'))
                                        <span id="password_confirm-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ",$errors->get('password_confirm')) }}
                                        </span>
                                    @endif
                                    </div>
                                    <div class="form-group mb-3">
                                    <label for="exampleInputEmail1"><strong>Số Điện Thoại</strong></label>
                                    <input type="text" class="form-control" value="{{ old('phone_number') }}" id="phone_number" name="phone_number" aria-describedby="emailHelp" placeholder="Nhập số điện thoại">
                                    @if ($errors->get('phone_number'))
                                        <span id="phone_number-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ",$errors->get('phone_number')) }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Tỉnh, Thành Phố</strong></label>
                                    <input type="text" class="form-control" value="{{ old('city') }}" id="city" name="city" aria-describedby="emailHelp" placeholder="Nhập Tỉnh, Thành Phố">
                                    @if ($errors->get('city'))
                                        <span id="city-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ",$errors->get('city')) }}
                                        </span>
                                    @endif
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Quận, Huyện</strong></label>
                                    <input type="text" class="form-control" value="{{ old('district') }}" id="district" name="district" aria-describedby="emailHelp" placeholder="Nhập Quận, Huyện">
                                    @if ($errors->get('district'))
                                        <span id="district-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ",$errors->get('district')) }}
                                        </span>
                                    @endif
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Phường, Xã</strong></label>
                                    <input type="text" class="form-control" value="{{ old('ward') }}" id="ward" name="ward" aria-describedby="emailHelp" placeholder="Nhập Phường, Xã">
                                    @if ($errors->get('ward'))
                                        <span id="ward-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ",$errors->get('ward')) }}
                                        </span>
                                    @endif
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Địa Chỉ Nhà</strong></label>
                                    <input type="text" class="form-control" value="{{ old('apartment_number') }}" id="apartment_number" name="apartment_number" aria-describedby="emailHelp" placeholder="Nhập địa chỉ nhà">
                                    @if ($errors->get('apartment_number'))
                                        <span id="apartment_number-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ",$errors->get('apartment_number')) }}
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success"><strong>Đăng Ký</strong></button>
                            </div>

                            <div class="content-footer text-center mt-3">
                                <span>Nếu bạn đã có tài khoản?</span>
                                <a href="{{ route('user.login') }}" class="ml-1"><strong>Đăng nhập</strong></a><span> ngay</span>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('#togglePassword');
            const passwordField = document.querySelector('#password');

            togglePassword.addEventListener('click', function (e) {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
            const passwordConfirmField = document.querySelector('#password_confirm');

            togglePasswordConfirm.addEventListener('click', function (e) {
                const type = passwordConfirmField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmField.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        });
    </script>
@endsection
