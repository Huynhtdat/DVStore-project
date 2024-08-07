<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ setting_website()->name }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="">

    <!-- all css here -->
    <link rel="stylesheet" href="{{ asset('assets\css\bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets\css\plugin.css')}}">
    <link rel="stylesheet" href="{{ asset('assets\css\bundle.css')}}">
    <link rel="stylesheet" href="{{ asset('assets\css\style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets\css\responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    {!! Toastr::message() !!}
    {{-- <link href="{{ asset('asset/client/css/style-product.css') }}" rel="stylesheet"> --}}
    <script src="{{ asset('assets\js\vendor\modernizr-2.8.3.min.js')}}"></script>

    @vite(['resources/client/css/auth.css', 'resources/client/css/home.css'])

</head>

<!--header area -->
<div class="header_area">
    <!--header top-->
     <div class="header_top">
        <div class="row align-items-center">
             <div class="col-lg-6 col-md-6">
                <div class="switcher">
                     <ul>
                        @if (Auth::check())
                        <li><a href="{{ route('profile.index') }}" title="My account">
                            <span>{{ Auth::user()->name }}</span>
                        </a></li>
                        @endif
                     </ul>
                 </div>
             </div>
             <div class="col-lg-6 col-md-6">
                 <div class="header_links">
                     <ul>
                        @if (Auth::check())
                            <li><a href="{{ route('wishlist.index') }}" title="wishlist">Yêu thích</a></li>

                            <li><a href="{{route('cart.index')}}" title="My cart">Giỏ hàng</a></li>
                            <li><a href="{{route('order_history.index')}}" title="Order history">Đơn hàng</a></li>
                        @else
                            <li><a href="{{route('user.login')}}" title="Login">Đăng nhập</a></li>
                            <li><a href="{{route('user.register')}}" title="Register">Đăng ký</a></li>
                        @endif
                     </ul>
                 </div>
             </div>
        </div>
     </div>
     <!--header top end-->

     <!--header middel-->
     <div class="header_middel">
         <div class="row align-items-center">
            <!--logo start-->
             <div class="col-lg-3 col-md-3">
                 <div class="logo">
                    <img src="{{ asset("asset/client/images/". setting_website()->logo)   }}" alt="DVShop" style="width: 50px; height: auto;">
                 </div>
             </div>
             <!--logo end-->
             <div class="col-lg-9 col-md-9">
                 <div class="header_right_info">
                     <div class="search_bar">
                         <form method="GET" action="{{ route('user.search') }}">
                             <input class="search-input" value="" name="keyword"
                                placeholder="Search..." type="text">
                             <button type="submit"><i class="fa fa-search"></i></button>
                         </form>
                     </div>
                     <div class="shopping_cart">
                        {{-- @if (Auth::check())
                            <a href="#"><i class="fa fa-shopping-cart"></i>
                                {{ $carts->sum('cart_quantity') }} Items -
                                {{ format_number_to_money($carts->sum(fn($cart) => $cart->product_price * $cart->cart_quantity)) }} VNĐ
                                <i class="fa fa-angle-down"></i>
                            </a> --}}

                            <!--mini cart-->
                            {{-- <div class="mini_cart">
                                @foreach ($carts as $cartItem)

                                        <div class="cart_item">
                                            <div class="cart_img">
                                                <a href="#"><img src="{{ asset('asset/client/images/products/small/' . $cartItem->product_image) }}" alt=""></a>
                                            </div>
                                            <div class="cart_info">
                                                <a href="#">{{ $cartItem->product_name }}</a>
                                                <span class="cart_price">Price: {{ $cartItem->product_price }} VND</span>
                                                <span class="quantity">Quantity: {{ $cartItem->cart_quantity }}</span>
                                            </div>
                                        </div>

                                @endforeach
                                <div class="cart_button">
                                    <a href="{{ route('checkout.index' )}}"> Check out</a>
                                </div>
                            </div> --}}
                            <!--mini cart end-->
                        {{-- @else --}}
                            <a href="{{route('cart.index')}}" title="My cart"><i class="fa fa-shopping-cart"></i></a>
                        {{-- @endif --}}
                    </div>
             </div>
         </div>
     </div></br>
     <!--header middel end-->
    <div class="header_bottom">
        <div class="row">
                <div class="col-12">
                    <div class="main_menu_inner">
                        <div class="main_menu d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li class=""><a href="{{route('user.home')}}">Trang chủ</a></li>
                                    </li>
                                    @foreach (category_header() as $category)
                                    <li class=" @php
                                        if (isset($request->slug) && $request->slug == $category->slug) {
                                        echo "active";
                                        }
                                    @endphp">
                                        <a href="{{ route('user.products', $category->slug) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                                    <li><a href="{{ route('user.introduction')}}">Giới thiệu</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="mobile-menu d-lg-none">
                            <nav>
                                <ul>
                                    <li><a href="{{route('user.home')}}">Trang chủ</a></li>
                                    @foreach (category_header() as $category)
                                    <li class=" @php
                                        if (isset($request->slug) && $request->slug == $category->slug) {
                                        echo "active";
                                        }
                                    @endphp">
                                        <a href="{{ route('user.products', $category->slug) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                                    <li><a href="blog.html">blog</a>
                                        <div>
                                            <div>
                                                <ul>
                                                    <li><a href="blog-details.html">blog details</a></li>
                                                    <li><a href="blog-fullwidth.html">blog fullwidth</a></li>
                                                    <li><a href="blog-sidebar.html">blog sidebar</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="contact.html">about us</a></li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<!--header end -->
</html>
