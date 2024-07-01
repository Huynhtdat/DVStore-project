@extends('layouts.user.main-client')

@section('content-client')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-white text-dark text-center rounded-top border-bottom">
                    <h2 class="section-title mb-0">Đăng Ký Tài Khoản</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.register') }}" method="POST" id="form__js">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label"><strong>Họ Và Tên</strong></label>
                                    <input type="text" class="form-control rounded-2" value="{{ old('name') }}" id="name" name="name" placeholder="Nhập họ và tên">
                                    @error('name')
                                    <span class="error text-danger">
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
                                    <input type="password" class="form-control rounded-2" value="{{ old('password') }}" id="password" name="password" placeholder="Nhập mật khẩu" autocomplete="new-password">
                                    @error('password')
                                    <span class="error invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class="form-label"><strong>Xác Nhận Mật Khẩu</strong></label>
                                    <input type="password" class="form-control rounded-2" value="{{ old('password_confirmation') }}" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận mật khẩu" autocomplete="new-password">
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
                                <div class="mb-3">
                                    <label for="city" class="form-label"><strong>Tỉnh, Thành Phố</strong></label>
                                    <input type="text" class="form-control rounded-2" id="city" name="city" value="{{ old('city') }}" placeholder="Nhập tỉnh, thành phố">
                                    @error('city')
                                        <span class="error text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="district" class="form-label"><strong>Quận, Huyện</strong></label>
                                    <input type="text" class="form-control rounded-2" id="district" name="district" value="{{ old('district') }}" placeholder="Nhập quận, huyện">
                                    @error('district')
                                        <span class="error invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="ward" class="form-label"><strong>Phường Xã</strong></label>
                                    <input type="text" class="form-control rounded-2" id="ward" name="ward" value="{{ old('ward') }}" placeholder="Nhập phường, xã">
                                    @error('ward')
                                        <span class="error invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="apartment_number" class="form-label"><strong>Địa Chỉ Nhà</strong></label>
                                    <input type="text" class="form-control rounded-2" id="apartment_number" name="apartment_number" value="{{ old('apartment_number') }}" placeholder="Nhập địa chỉ nhà">
                                    @error('apartment_number')
                                        <span class="error invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5"><strong>Đăng Ký</strong></button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-white rounded-bottom border-top-0">
                    <p class="mb-0">Bạn đã có tài khoản? <a href="{{ route('user.login') }}" class="text-primary"><strong>Đăng nhập</strong></a> ngay.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
