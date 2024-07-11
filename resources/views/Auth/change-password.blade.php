@extends('layouts.user.main-client')
@section('content-client')
        <style>
            .input-group-text {
                display: flex;
                justify-content: center; /* Căn giữa theo chiều ngang */
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
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" value="{{ old('password') }}" id="password" name="password" placeholder="Nhập mật khẩu mới">
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
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1"><strong>Xác Nhận Mật Khẩu Mới</strong></label>
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
<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility for "Mật Khẩu"
            const togglePassword = document.querySelector('#togglePassword');
            const passwordField = document.querySelector('#password');

            togglePassword.addEventListener('click', function (e) {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            // Toggle password visibility for "Xác Nhận Mật Khẩu"
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
@vite(['resources/client/js/register.js'])
@endsection
