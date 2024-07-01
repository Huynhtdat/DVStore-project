@extends('layouts.user.main-client')

@section('content-client')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul>
                    <li><a href="{{ route('user.home') }}">home</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>Cart</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--shopping cart area start -->
<div class="shopping_cart_area">
    @if (count(\Cart::getContent()) <= 0)
        <h3 class="text-center">Your cart is empty</h3>
        <div class="text-center" style="padding-top: 50px">
            <div class="col-md-12 wided-box text-center">
                <button type="submit"><i class="fa fa-shopping-cart"></i> add to cart</button>
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
                                        <th class="product_thumb">Image</th>
                                        <th class="product_name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product_quantity">Quantity</th>
                                        <th class="product_total">Total</th>
                                        <th class="product_remove">Tools</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td class="product_thumb">
                                                <a href="#"><img style="max-width: 50%;" src="{{ asset('asset/client/images/products/small/' . $cart->attributes->image) }}" alt="Product Image"></a>
                                            </td>
                                            <td class="product_name">
                                                <a href="#">
                                                    {{ $cart->name }}
                                                    <p>Color: <strong>{{ $cart->attributes->color }}</strong></p>
                                                    <p>Size: <strong>{{ $cart->attributes->size }}</strong></p>
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
                                                        <button type="submit" class="btn btn-primary">Update</button>
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
                            <h3>Cart Totals</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal">
                                    <p>Quantity total: </p>
                                    <p class="cart_amount"><span>{{ Cart::getTotalQuantity()}}</span>Items</p>
                                </div>
                                <div class="cart_subtotal">
                                    <p>Total</p>
                                    <p class="cart_amount">{{ format_number_to_money(Cart::getTotal()) }}</p>
                                </div>
                                <div class="checkout_btn">
                                    <a href="{{ route('checkout.index') }}">Proceed to Checkout</a>
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
