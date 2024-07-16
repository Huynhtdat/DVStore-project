@extends('layouts.user.main-client')

@section('content-client')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul>
                    <li><a href="{{ route('user.home') }}">Trang chủ</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>Giỏ hàng</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--shopping cart area start -->
<div class="shopping_cart_area">
    @if (count(\Cart::getContent()) <= 0)
        <h3 class="text-center"> Giỏ hàng cảu bạn đang trống</h3>
        <div class="text-center" style="padding-top: 50px">
            <div class="col-md-12 wided-box text-center">
                <button type="submit"><i class="btn btn-primary fa fa-shopping-cart"></i>Mua ngay</button>
            </div>
        </div>
    @else
        <form action="{{ route('cart.update') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="cart_page table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product_thumb">Hình ảnh</th>
                                        <th class="product_name">Sản phẩm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product_quantity">Số lượng</th>
                                        <th class="product_total">Tổng tiền</th>
                                        <th class="product_remove">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td class="product_thumb">
                                                <a href="">
                                                    <img style="max-width: 50%;" src="{{ asset('asset/client/images/products/small/' . $cart->attributes->image) }}" alt="Product Image">
                                                </a>
                                            </td>
                                            <td class="product_name">
                                                <a href="">
                                                    {{ $cart->name }}
                                                    <p>Màu sắc: <strong>{{ $cart->attributes->color }}</strong></p>
                                                    <p>Kích thước: <strong>{{ $cart->attributes->size }}</strong></p>
                                                </a>
                                            </td>
                                            <td class="product-price">{{ format_number_to_money($cart->price) }}</td>
                                            <td class="product_quantity">
                                                <input type="hidden" name="id[]" value="{{ $cart->id }}">
                                                <input min="1" max="100" name="quantity[]" type="number" value="{{ $cart->quantity }}">
                                            </td>
                                            <td class="product_total">{{ format_number_to_money($cart->price * $cart->quantity) }}</td>
                                            <td class="product_remove">
                                                <div class="d-flex align-items-center">
                                                    <div class="cart_submit mr-2">
                                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                    </div>
                                                    <a href="{{ route('cart.delete', $cart->id) }}">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--coupon code area start-->
            <div class="coupon_area">
                <div class="row">
                    <div class="col-lg-6 col-md-6"></div>
                    <div class="col-lg-6 col-md-6">
                        <div class="coupon_code">
                            <h3>Tổng giỏ hàng</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal">
                                    <p>Tổng số lượng: </p>
                                    <p class="cart_amount"><span>{{ Cart::getTotalQuantity()}}</span> Sản phẩm</p>
                                </div>
                                <div class="cart_subtotal">
                                    <p>Tổng cộng</p>
                                    <p class="cart_amount">{{ format_number_to_money(Cart::getTotal())}} VNĐ</p>
                                </div>
                                <div class="checkout_btn">
                                    <a href="{{ route('checkout.index') }}">Thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--coupon code area end-->
        </form>
    @endif
</div>
<!--shopping cart area end -->
@vite(['resources/client/css/cart.css'])
@endsection
