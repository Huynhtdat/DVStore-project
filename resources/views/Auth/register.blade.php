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
                              <label for="exampleInputEmail1"><strong>Họ Và Tên</strong></label>
                              <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" aria-describedby="emailHelp" placeholder="Nhập họ và tên">
                              @if ($errors->get('name'))
                                <span id="name-error" class="error invalid-feedback" style="display: block">
                                  {{ implode(", ",$errors->get('name')) }}
                                </span>
                              @endif
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Email</strong></label>
                              <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" aria-describedby="emailHelp" placeholder="Nhập email">
                              @if ($errors->get('email'))
                                <span id="email-error" class="error invalid-feedback" style="display: block">
                                  {{ implode(", ",$errors->get('email')) }}
                                </span>
                              @endif
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1"><strong>Mật Khẩu</strong></label>
                              <input type="password" class="form-control" value="{{ old('password') }}" id="password" name="password" placeholder="Nhập mật khẩu">
                              @if ($errors->get('password'))
                                <span id="password-error" class="error invalid-feedback" style="display: block">
                                  {{ implode(", ",$errors->get('password')) }}
                                </span>
                              @endif
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1"><strong>Xác Nhận Mật Khẩu</strong></label>
                              <input type="password" class="form-control" value="{{ old('password_confirmation') }}" id="password_confirm" name="password_confirm" placeholder="Xác nhận mật khẩu">
                              @if ($errors->get('password_confirm'))
                                <span id="password_confirm-error" class="error invalid-feedback" style="display: block">
                                  {{ implode(", ",$errors->get('password_confirm')) }}
                                </span>
                              @endif
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Số Điện Thoại</strong></label>
                              <input type="text" class="form-control" value="{{ old('phone_number') }}" id="phone_number" name="phone_number" aria-describedby="emailHelp" placeholder="Nhập số điện thoại">
                              @if ($errors->get('phone_number'))
                                <span id="phone_number-error" class="error invalid-feedback" style="display: block">
                                  {{ implode(", ",$errors->get('phone_number')) }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Tỉnh, Thành Phố</strong></label>
                              <select class="form-control form-select" id="city" name="city">
                                @foreach ($citys as $city)
                                    <option value="{{ $city['ProvinceID'] }}"
                                    @if ( $city['ProvinceID'] == old('city'))
                                        selected
                                    @endif
                                    >{{ $city['NameExtension'][1] }}</option>
                                @endforeach
                              </select>
                              @if ($errors->get('city'))
                                <span id="city-error" class="error invalid-feedback" style="display: block">
                                  {{ implode(", ",$errors->get('city')) }}
                                </span>
                              @endif
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Quận, Huyện</strong></label>
                              <select class="form-control form-select" id="district" name="district">
                                @foreach ($districts as $district)
                                    <option value="{{ $district['DistrictID'] }}"
                                    @if ( $district['DistrictID'] == old('district'))
                                        selected
                                    @endif
                                    >{{ $district['DistrictName'] }}</option>
                                @endforeach
                              </select>
                              @if ($errors->get('district'))
                                <span id="district-error" class="error invalid-feedback" style="display: block">
                                  {{ implode(", ",$errors->get('district')) }}
                                </span>
                              @endif
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Phường Xã</strong></label>
                              <select class="form-control form-select" id="ward" name="ward">
                                @foreach ($wards as $ward)
                                    <option value="{{ $ward['WardCode'] }}"
                                    @if ( $ward['WardCode'] == old('ward'))
                                      selected
                                    @endif
                                    >{{ $ward['WardName'] }}</option>
                                @endforeach
                              </select>
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
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #007bff;"><strong>Đăng Ký</strong></button> <br></br>
                            </div>
                            <div class="card-footer text-center">
                                <p class="mb-0">Hoặc đăng ký</p>
                                <div class="row justify-content-center mt-2">
                                    <a href="{{ route('social.login', 'facebook') }}" class="btn btn-primary social-btn col-5 mx-2">
                                        <i class="fab fa-facebook-f"></i> Facebook
                                    </a>
                                    <a href="{{ route('social.login', 'google') }}" class="btn btn-danger social-btn col-5 mx-2" style="margin-left: 10px;">
                                        <i class="fab fa-google"></i> Google
                                    </a>
                                </div></br>
                                <p class="mt-3 mb-0">Bạn đã có tài khoản? <a href="{{ route('user.login') }}"><strong>Đăng nhập</strong></a> ngay.</p>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
              </ol>
            </div>
          </div>
    </div>
</div>
@vite(['resources/client/js/register.js'])
@endsection
