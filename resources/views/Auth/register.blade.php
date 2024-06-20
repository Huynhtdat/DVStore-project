@extends('layouts.user.layout')

@section('content')
<div class="container_fullwidth content-page">
    <div class="container">
        <div class="col-md-12 container-page">
            <div class="checkout-page">
                <ol class="checkout-steps">
                    <li class="steps active">
                        <h4 class="title-steps text-center">Đăng Kí Tài Khoản</h4>
                        <div class="step-description">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="run-customer">
                                        <div id="form-data" hidden data-rules="{{ json_encode($rules) }}"
                                            data-messages="{{ json_encode($messages) }}"></div>
                                        <form action="{{ route('user.register') }}" method="POST" id="form__js">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name"><strong>Họ Và Tên</strong></label>
                                                <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" placeholder="Nhập họ và tên">
                                                @error('name')
                                                    <span class="error invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email"><strong>Email</strong></label>
                                                <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Nhập email">
                                                @error('email')
                                                    <span class="error invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password"><strong>Mật Khẩu</strong></label>
                                                <input type="password" class="form-control" value="{{ old('password') }}" id="password" name="password" placeholder="Nhập mật khẩu">
                                                @error('password')
                                                    <span class="error invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password_confirmation"><strong>Xác Nhận Mật Khẩu</strong></label>
                                                <input type="password" class="form-control" value="{{ old('password_confirmation') }}" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận mật khẩu">
                                                @error('password_confirmation')
                                                    <span class="error invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="phone_number"><strong>Số Điện Thoại</strong></label>
                                                <input type="text" class="form-control" value="{{ old('phone_number') }}" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại">
                                                @error('phone_number')
                                                    <span class="error invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="city"><strong>Tỉnh, Thành Phố</strong></label>
                                                <select class="form-control form-select" id="city" name="city">
                                                    <option value="">Chọn tỉnh, thành phố</option>
                                                    @forelse ($cities as $city)
                                                        @if (isset($city['ProvinceID']) && isset($city['NameExtension'][1]))
                                                            <option value="{{ $city['ProvinceID'] }}"
                                                                {{ old('city') == $city['ProvinceID'] ? 'selected' : '' }}>
                                                                {{ $city['NameExtension'][1] }}
                                                            </option>
                                                        @endif
                                                    @empty
                                                        <option value="">Không có dữ liệu tỉnh/thành phố</option>
                                                    @endforelse
                                                </select>
                                                @error('city')
                                                    <span class="error invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="district"><strong>Quận, Huyện</strong></label>
                                                <select class="form-control form-select" id="district" name="district">
                                                    <option value="">Chọn quận, huyện</option>
                                                    <!-- Options will be dynamically populated based on city selection -->
                                                </select>
                                                @error('district')
                                                    <span class="error invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="ward"><strong>Phường Xã</strong></label>
                                                <select class="form-control form-select" id="ward" name="ward">
                                                    <option value="">Chọn phường, xã</option>
                                                    <!-- Options will be dynamically populated based on district selection -->
                                                </select>
                                                @error('ward')
                                                    <span class="error invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="apartment_number"><strong>Địa Chỉ Nhà</strong></label>
                                                <input type="text" class="form-control" value="{{ old('apartment_number') }}" id="apartment_number" name="apartment_number" placeholder="Nhập địa chỉ nhà">
                                                @error('apartment_number')
                                                    <span class="error invalid-feedback" style="display: block">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary"><strong>Đăng Ký</strong></button> <br><br>
                                            </div>
                                            <div class="card-footer text-center">
                                                <p class="mb-0">Hoặc đăng ký</p>
                                                <div class="row justify-content-center mt-2">
                                                    <a href="#" class="btn btn-primary social-btn col-5 mx-2">
                                                        <i class="fab fa-facebook-f"></i> Facebook
                                                    </a>
                                                    <a href="{{ route('google-auth', 'google') }}" class="btn btn-danger social-btn col-5 mx-2" style="margin-left: 10px;">
                                                        <i class="fab fa-google"></i> Google
                                                    </a>
                                                </div><br>
                                                <p class="mt-3 mb-0">Bạn đã có tài khoản? <a href="{{ route('user.login') }}"><strong>Đăng nhập</strong></a> ngay.</p>
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
