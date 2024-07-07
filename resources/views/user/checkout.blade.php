@extends('layouts.user.main-client')
@section('content-client')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Giỏ hàng</a></li>
                    <li class="breadcrumb-item active">Thanh toán</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<div class="container">

    <div class="container">
        <form action="{{ route('checkout.index') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="title-steps">Thông Tin Cá Nhân</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name"><strong>Họ Và Tên</strong></label>
                                <input type="text" class="form-control" disabled value="{{ $fullName }}" id="name" name="name" placeholder="Nhập họ và tên">
                                @if ($errors->get('name'))
                                <span id="name-error" class="invalid-feedback" style="display: block">
                                    {{ implode(", ",$errors->get('name')) }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email"><strong>Email</strong></label>
                                <input type="text" class="form-control" disabled value="{{ $email }}" id="email" name="email" placeholder="Nhập địa chỉ email">
                                @if ($errors->get('email'))
                                <span id="email-error" class="invalid-feedback" style="display: block">
                                    {{ implode(", ",$errors->get('email')) }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone_number"><strong>Số điện thoại</strong></label>
                                <input type="text" class="form-control" disabled value="{{ $phoneNumber }}" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại">
                                @if ($errors->get('phone_number'))
                                <span id="phone_number-error" class="invalid-feedback" style="display: block">
                                    {{ implode(", ",$errors->get('phone_number')) }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="city"><strong>Tỉnh, Thành Phố</strong></label>
                                <input type="text" class="form-control" disabled value="{{ $city }}" id="city" name="city" placeholder="Nhập thành phố">
                                @if ($errors->get('city'))
                                <span id="city-error" class="invalid-feedback" style="display: block">
                                    {{ implode(", ",$errors->get('city')) }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="district"><strong>Quận, Huyện</strong></label>
                                <input type="text" class="form-control" disabled value="{{ $district }}" id="district" name="district" placeholder="Nhập quận, huyện">
                                @if ($errors->get('district'))
                                <span id="district-error" class="invalid-feedback" style="display: block">
                                    {{ implode(", ",$errors->get('district')) }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="ward"><strong>Phường Xã</strong></label>
                                <input type="text" class="form-control" disabled value="{{ $ward }}" id="ward" name="ward" placeholder="Nhập phường, xã">
                                @if ($errors->get('ward'))
                                <span id="ward-error" class="invalid-feedback" style="display: block">
                                    {{ implode(", ",$errors->get('ward')) }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="apartment_number"><strong>Địa Chỉ Nhà</strong></label>
                                <input type="text" class="form-control" disabled value="{{ $apartment_number }}" id="apartment_number" name="apartment_number" placeholder="Nhập địa chỉ nhà">
                                @if ($errors->get('apartment_number'))
                                <span id="apartment_number-error" class="invalid-feedback" style="display: block">
                                    {{ implode(", ",$errors->get('apartment_number')) }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="title-steps">Thông Tin Đơn Hàng</h4>
                        </div>
                        <div class="card-body">
                            <div class="info-order">
                                <div class="d-flex justify-content-between">
                                    <span><strong>Tổng tiền sản phẩm:</strong></span>
                                    <span id="total-product">{{ format_number_to_money(Cart::getTotal()) }}</span>
                                </div>
                            </div>
                            <div class="info-order">
                                <div class="d-flex justify-content-between">
                                    <span><strong>Phí vận chuyển:</strong></span>
                                    <span id="fee">0</span>
                                </div>
                            </div>
                            <div class="info-order">
                                <div class="d-flex justify-content-between">
                                    <span><strong>Áp dụng giảm giá:</strong></span>
                                    <span>0</span>
                                </div>
                            </div>
                            <div class="info-order">
                                <div class="d-flex justify-content-between">
                                    <span><strong>Tổng đơn hàng:</strong></span>
                                    <input id="total-order-input" value="{{ Cart::getTotal() }}" type="text" hidden>
                                    <span id="total-order">0</span>
                                </div>
                            </div>
                            <div class="payment-method mb-4">
                                <span class="d-block mb-2"><strong>Chọn phương thức thanh toán</strong></span>
                                @if ($errors->get('payment_method'))
                                <div id="payment_method-error" class="invalid-feedback d-block">
                                    {{ implode(", ",$errors->get('payment_method')) }}
                                </div>
                                @endif
                            </div>
                            <div class="list-group">
                                @foreach ($payments as $payment)
                                <div class="list-group-item list-group-item-action d-flex align-items-center">
                                    <input class="form-check-input" style="width: 3em; height: 1.2em; margin-right: 3em;" type="radio" value="{{ $payment->id }}" name="payment_method" id="{{ $payment->id }}">
                                    <img src="{{ asset("asset/imgs/$payment->img") }}" alt="{{ $payment->name }}" class="img-fluid ms-4 me-2" style="max-height: 40px; margin-left: 1.5em; margin-right: 0.5em;">
                                    <label class="form-check-label flex-grow-1 mb-0" for="{{ $payment->id }}">
                                        {{ $payment->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="text-center mt-4">
                                <button class="btn btn-info">Thanh Toán Đơn Hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@vite(['resources/client/js/checkout.js', 'resources/client/css/checkout.css'])

@endsection
