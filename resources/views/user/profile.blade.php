@extends('layouts.user.main-client')
@section('content-client')

<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>Trang cá nhân</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!-- Start Maincontent  -->
<section class="main_content_area">
    <div class="account_dashboard">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <!-- Nav tabs -->
                <div class="dashboard_tab_button">
                    <ul role="tablist" class="nav flex-column dashboard-list">
                        <li><a href="#dashboard" data-toggle="tab" class="nav-link active">Thông tin cá nhân</a></li>
                        <li><a href="#orders" data-toggle="tab" class="nav-link">Đổi mật khẩu</a></li>
                        <li><a href="#address" data-toggle="tab" class="nav-link">Thay đổi địa chỉ</a></li>
                        <li><a href="{{ route('user.logout') }}" class="nav-link">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <!-- Tab panes -->
                <div class="tab-content dashboard_content">
                    <div class="tab-pane fade show active" id="dashboard">
                        <h3>Thông tin cá nhân</h3>
                        <div class="step-description">
                            <div class="your-details row">
                                <form action="{{ route('profile.change_profile') }}" method="post" style="width: 100%;">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Họ Và Tên</label>
                                        <input type="text" class="form-control" value="{{ $fullName }}" id="name" name="name" placeholder="Nhập họ và tên">
                                        @if ($errors->get('name'))
                                            <span id="name-error" class="error invalid-feedback" style="display: block">
                                                {{ implode(", ", $errors->get('name')) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" value="{{ $email }}" id="email" name="email" placeholder="Nhập địa chỉ email">
                                        @if ($errors->get('email'))
                                            <span id="email-error" class="error invalid-feedback" style="display: block">
                                                {{ implode(", ", $errors->get('email')) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">Số điện thoại</label>
                                        <input type="text" class="form-control" value="{{ $phoneNumber }}" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại">
                                        @if ($errors->get('phone_number'))
                                            <span id="phone_number-error" class="error invalid-feedback" style="display: block">
                                                {{ implode(", ", $errors->get('phone_number')) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" value="{{ $city }}" id="city" name="city" placeholder="Nhập thành phố">
                                        @if ($errors->get('city'))
                                            <span id="city-error" class="error invalid-feedback" style="display: block">
                                                {{ implode(", ", $errors->get('city')) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" value="{{ $district }}" id="district" name="district" placeholder="Nhập quận">
                                        @if ($errors->get('district'))
                                            <span id="district-error" class="error invalid-feedback" style="display: block">
                                                {{ implode(", ", $errors->get('district')) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" value="{{ $ward }}" id="ward" name="ward" placeholder="Nhập phường">
                                        @if ($errors->get('ward'))
                                            <span id="ward-error" class="error invalid-feedback" style="display: block">
                                                {{ implode(", ", $errors->get('ward')) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" value="{{ $apartment_number }}" id="apartment_number" name="apartment_number" placeholder="Nhập địa chỉ nhà">
                                        @if ($errors->get('apartment_number'))
                                            <span id="apartment_number-error" class="error invalid-feedback" style="display: block">
                                                {{ implode(", ", $errors->get('apartment_number')) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div style="padding-top: 5px;" class="text-center">
                                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="orders">
                        <h3>Thay đổi mật khẩu</h3>
                        <form action="{{ route('profile.change_password') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="current_password">Mật Khẩu Hiện Tại</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" value="{{ old('current_password') }}" id="current_password" name="current_password" placeholder="Nhập mật khẩu hiện tại">
                                    <span class="input-group-text toggle-password" onclick="togglePassword('current_password')">
                                        <i class="fa fa-eye" id="toggleCurrentPassword"></i>
                                    </span>
                                </div>
                                @if ($errors->get('current_password'))
                                    <span id="current_password-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ", $errors->get('current_password')) }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="new_password">Mật Khẩu Mới</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" value="{{ old('new_password') }}" id="new_password" name="new_password" placeholder="Nhập mật khẩu mới">
                                    <span class="input-group-text toggle-password" onclick="togglePassword('new_password')">
                                        <i class="fa fa-eye" id="toggleNewPassword"></i>
                                    </span>
                                </div>
                                @if ($errors->get('new_password'))
                                    <span id="new_password-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ", $errors->get('new_password')) }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Xác Nhận Mật Khẩu Mới</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" value="{{ old('confirm_password') }}" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu mới">
                                    <span class="input-group-text toggle-password" onclick="togglePassword('confirm_password')">
                                        <i class="fa fa-eye" id="toggleConfirmPassword"></i>
                                    </span>
                                </div>
                                @if ($errors->get('confirm_password'))
                                    <span id="confirm_password-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ", $errors->get('confirm_password')) }}
                                    </span>
                                @endif
                            </div>
                            <div style="padding-top: 5px;" class="text-center">
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="address">
                        <h3>Thay đổi địa chỉ</h3>
                        <form action="{{ route('profile.change_profile') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" class="form-control" value="{{ $fullName }}" id="name" name="name" placeholder="Nhập họ và tên">
                                @if ($errors->get('name'))
                                    <span id="name-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ", $errors->get('name')) }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" value="{{ $email }}" id="email" name="email" placeholder="Nhập địa chỉ email">
                                @if ($errors->get('email'))
                                    <span id="email-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ", $errors->get('email')) }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" value="{{ $phoneNumber }}" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại">
                                @if ($errors->get('phone_number'))
                                    <span id="phone_number-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ", $errors->get('phone_number')) }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="city">Tỉnh/Thành Phố</label>
                                <input type="text" class="form-control" value="{{ $city }}" id="city" name="city" placeholder="Nhập tỉnh/thành phố">
                                @if ($errors->get('city'))
                                    <span id="city-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ", $errors->get('city')) }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="district">Quận/Huyện</label>
                                <input type="text" class="form-control" value="{{ $district }}" id="district" name="district" placeholder="Nhập quận/huyện">
                                @if ($errors->get('district'))
                                    <span id="district-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ", $errors->get('district')) }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="ward">Phường/Xã</label>
                                <input type="text" class="form-control" value="{{ $ward }}" id="ward" name="ward" placeholder="Nhập phường/xã">
                                @if ($errors->get('ward'))
                                    <span id="ward-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ", $errors->get('ward')) }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="apartment_number">Địa Chỉ Nhà</label>
                                <input type="text" class="form-control" value="{{ $apartment_number }}" id="apartment_number" name="apartment_number" placeholder="Nhập địa chỉ nhà">
                                @if ($errors->get('apartment_number'))
                                    <span id="apartment_number-error" class="error invalid-feedback" style="display: block">
                                        {{ implode(", ", $errors->get('apartment_number')) }}
                                    </span>
                                @endif
                            </div>
                            <div style="padding-top: 5px;" class="text-center">
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Maincontent  -->

@endsection
