@extends('layouts.user.layout')

@section('content')
<div class="container_fullwidth content-page">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card rounded-3 shadow-sm">
                    <div class="card-header text-center bg-primary text-white rounded-top">
                        <h4 class="title-steps">Đăng Kí Tài Khoản</h4>
                    </div>
                    <div class="card-body">
                        <div id="form-data" hidden data-rules="{{ json_encode($rules) }}" data-messages="{{ json_encode($messages) }}"></div>
                        <form action="{{ route('user.register') }}" method="POST" id="form__js">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label"><strong>Họ Và Tên</strong></label>
                                        <input type="text" class="form-control rounded-2" value="{{ old('name') }}" id="name" name="name" placeholder="Nhập họ và tên">
                                        @error('name')
                                            <span class="error invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label"><strong>Email</strong></label>
                                        <input type="email" class="form-control rounded-2" value="{{ old('email') }}" id="email" name="email" placeholder="Nhập email">
                                        @error('email')
                                            <span class="error invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label"><strong>Mật Khẩu</strong></label>
                                        <input type="password" class="form-control rounded-2" value="{{ old('password') }}" id="password" name="password" placeholder="Nhập mật khẩu">
                                        @error('password')
                                            <span class="error invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password_confirmation" class="form-label"><strong>Xác Nhận Mật Khẩu</strong></label>
                                        <input type="password" class="form-control rounded-2" value="{{ old('password_confirmation') }}" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận mật khẩu">
                                        @error('password_confirmation')
                                            <span class="error invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="phone_number" class="form-label"><strong>Số Điện Thoại</strong></label>
                                        <input type="text" class="form-control rounded-2" value="{{ old('phone_number') }}" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại">
                                        @error('phone_number')
                                            <span class="error invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="city" class="form-label"><strong>Tỉnh, Thành Phố</strong></label>
                                        <select class="form-control form-select w-100 rounded-2" id="city" name="city">
                                            <option value="">Chọn tỉnh, thành phố</option>
                                            @forelse ($cities as $city)
                                                @if (isset($city['ProvinceID']) && isset($city['NameExtension'][1]))
                                                    <option value="{{ $city['ProvinceID'] }}" {{ old('city') == $city['ProvinceID'] ? 'selected' : '' }}>
                                                        {{ $city['NameExtension'][1] }}
                                                    </option>
                                                @endif
                                            @empty
                                                <option value="">Không có dữ liệu tỉnh/thành phố</option>
                                            @endforelse
                                        </select>
                                        @error('city')
                                            <span class="error invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="district" class="form-label"><strong>Quận, Huyện</strong></label>
                                        <select class="form-control form-select rounded-2" id="district" name="district">
                                            <option value="">Chọn quận, huyện</option>
                                            <!-- Options will be dynamically populated based on city selection -->
                                        </select>
                                        @error('district')
                                            <span class="error invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="ward" class="form-label"><strong>Phường Xã</strong></label>
                                        <select class="form-control form-select rounded-2" id="ward" name="ward">
                                            <option value="">Chọn phường, xã</option>
                                            <!-- Options will be dynamically populated based on district selection -->
                                        </select>
                                        @error('ward')
                                            <span class="error invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="apartment_number" class="form-label"><strong>Địa Chỉ Nhà</strong></label>
                                        <input type="text" class="form-control rounded-2" value="{{ old('apartment_number') }}" id="apartment_number" name="apartment_number" placeholder="Nhập địa chỉ nhà">
                                        @error('apartment_number')
                                            <span class="error invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-50 rounded-2"><strong>Đăng Ký</strong></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center rounded-bottom">
                        <p class="mb-1">Hoặc đăng ký</p>
                        <div class="row justify-content-center">
                            <a href="{{ route('google-auth', 'google') }}" class="btn btn-danger social-btn col-5 mb-2 rounded-2">
                                <i class="fab fa-google"></i> Sign Up with Google
                            </a>
                        </div>
                        <p class="mt-3 mb-0">Bạn đã có tài khoản? <a href="{{ route('user.login') }}"><strong>Đăng nhập</strong></a> ngay.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@vite(['resources/client/js/register.js'])
@endsection
