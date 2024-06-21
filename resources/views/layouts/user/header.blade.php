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
                         <li class="languages"><a href="#"><img src="assets\img\logo\fontlogo.jpg" alt=""> English <i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown_languages">
                                 <li><a href="#"><img src="assets\img\logo\fontlogo.jpg" alt=""> English</a></li>
                                 <li><a href="#"><img src="assets\img\logo\fontlogo2.jpg" alt=""> French </a></li>
                             </ul>
                         </li>

                     </ul>
                 </div>
             </div>
             <div class="col-lg-6 col-md-6">
                 <div class="header_links">
                     <ul>
                        @if (Auth::check())
                            <li><a href="wishlist.html" title="wishlist">My wishlist</a></li>
                            <li><a href="my-account.html" title="My account">
                                <span>{{ Auth::user()->name }}</span>
                            </a></li>
                            <li><a href="cart.html" title="My cart">My cart</a></li>
                        @else
                            <li><a href="{{route('user.login')}}" title="Login">Login</a></li>
                            <li><a href="{{route('user.register')}}" title="Register">Register</a></li>
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
                    <img src="{{ asset("asset/client/images/"  ) }}" alt="LogoShop">
                 </div>
             </div>
             <!--logo end-->
             <div class="col-lg-9 col-md-9">
                 <div class="header_right_info">
                     <div class="search_bar">
                         <form action="#">
                             <input placeholder="Search..." type="text">
                             <button type="submit"><i class="fa fa-search"></i></button>
                         </form>
                     </div>
                     <div class="shopping_cart">
                         <a href="#"><i class="fa fa-shopping-cart"></i> 2Items - $209.44 <i class="fa fa-angle-down"></i></a>

                         <!--mini cart-->
                         <div class="mini_cart">
                             <div class="cart_item">
                                <div class="cart_img">
                                    <a href="#"><img src="assets\img\cart\cart.jpg" alt=""></a>
                                </div>
                                 <div class="cart_info">
                                     <a href="#">lorem ipsum dolor</a>
                                     <span class="cart_price">$115.00</span>
                                     <span class="quantity">Qty: 1</span>
                                 </div>
                                 <div class="cart_remove">
                                     <a title="Remove this item" href="#"><i class="fa fa-times-circle"></i></a>
                                 </div>
                             </div>
                             <div class="cart_item">
                                <div class="cart_img">
                                    <a href="#"><img src="assets\img\cart\cart2.jpg" alt=""></a>
                                </div>
                                 <div class="cart_info">
                                     <a href="#">Quisque ornare dui</a>
                                     <span class="cart_price">$105.00</span>
                                     <span class="quantity">Qty: 1</span>
                                 </div>
                                 <div class="cart_remove">
                                     <a title="Remove this item" href="#"><i class="fa fa-times-circle"></i></a>
                                 </div>
                             </div>
                             <div class="shipping_price">
                                 <span> Shipping </span>
                                 <span>  $7.00  </span>
                             </div>
                             <div class="total_price">
                                 <span> total </span>
                                 <span class="prices">  $227.00  </span>
                             </div>
                             <div class="cart_button">
                                 <a href="checkout.html"> Check out</a>
                             </div>
                         </div>
                         <!--mini cart end-->
                     </div>

                 </div>
             </div>
         </div>
     </div>
     <!--header middel end-->
 <div class="header_bottom">
     <div class="row">
             <div class="col-12">
                 <div class="main_menu_inner">
                     <div class="main_menu d-none d-lg-block">
                         <nav>
                             <ul>
                                 <li class="active"><a href="{{route('user.home')}}">Home</a></li>

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
                                 {{-- <li><a href="#">women</a>
                                     <div class="mega_menu">
                                         <div class="mega_top fix">
                                             <div class="mega_items">
                                                 <h3><a href="#">Accessories</a></h3>
                                                 <ul>
                                                     <li><a href="#">Cocktai</a></li>
                                                     <li><a href="#">day</a></li>
                                                     <li><a href="#">Evening</a></li>
                                                     <li><a href="#">Sundresses</a></li>
                                                     <li><a href="#">Belts</a></li>
                                                     <li><a href="#">Sweets</a></li>
                                                 </ul>
                                             </div>
                                             <div class="mega_items">
                                                 <h3><a href="#">HandBags</a></h3>
                                                 <ul>
                                                     <li><a href="#">Accessories</a></li>
                                                     <li><a href="#">Hats and Gloves</a></li>
                                                     <li><a href="#">Lifestyle</a></li>
                                                     <li><a href="#">Bras</a></li>
                                                     <li><a href="#">Scarves</a></li>
                                                     <li><a href="#">Small Leathers</a></li>
                                                 </ul>
                                             </div>
                                             <div class="mega_items">
                                                 <h3><a href="#">Tops</a></h3>
                                                 <ul>
                                                     <li><a href="#">Evening</a></li>
                                                     <li><a href="#">Long Sleeved</a></li>
                                                     <li><a href="#">Shrot Sleeved</a></li>
                                                     <li><a href="#">Tanks and Camis</a></li>
                                                     <li><a href="#">Sleeveless</a></li>
                                                     <li><a href="#">Sleeveless</a></li>
                                                 </ul>
                                             </div>
                                         </div>
                                         <div class="mega_bottom fix">
                                             <div class="mega_thumb">
                                                 <a href="#"><img src="assets\img\banner\banner1.jpg" alt=""></a>
                                             </div>
                                             <div class="mega_thumb">
                                                 <a href="#"><img src="assets\img\banner\banner2.jpg" alt=""></a>
                                             </div>
                                         </div>
                                     </div>
                                 </li>
                                 <li><a href="#">men</a>
                                     <div class="mega_menu">
                                         <div class="mega_top fix">
                                             <div class="mega_items">
                                                 <h3><a href="#">Rings</a></h3>
                                                 <ul>
                                                     <li><a href="#">Platinum Rings</a></li>
                                                     <li><a href="#">Gold Ring</a></li>
                                                     <li><a href="#">Silver Ring</a></li>
                                                     <li><a href="#">Tungsten Ring</a></li>
                                                     <li><a href="#">Sweets</a></li>
                                                 </ul>
                                             </div>
                                             <div class="mega_items">
                                                 <h3><a href="#">Bands</a></h3>
                                                 <ul>
                                                     <li><a href="#">Platinum Bands</a></li>
                                                     <li><a href="#">Gold Bands</a></li>
                                                     <li><a href="#">Silver Bands</a></li>
                                                     <li><a href="#">Silver Bands</a></li>
                                                     <li><a href="#">Sweets</a></li>
                                                 </ul>
                                             </div>
                                             <div class="mega_items">
                                                 <a href="#"><img src="assets\img\banner\banner3.jpg" alt=""></a>
                                             </div>
                                         </div>

                                     </div> --}}
                                 </li>

                                 <li><a href="blog.html">blog</a>
                                     <div class="mega_menu jewelry">
                                         <div class="mega_items jewelry">
                                             <ul>
                                                 <li><a href="blog-details.html">blog details</a></li>
                                                 <li><a href="blog-fullwidth.html">blog fullwidth</a></li>
                                                 <li><a href="blog-sidebar.html">blog sidebar</a></li>
                                             </ul>
                                         </div>
                                     </div>
                                 </li>
                                 <li><a href="contact.html">contact us</a></li>

                             </ul>
                         </nav>
                     </div>
                     <div class="mobile-menu d-lg-none">
                         <nav>
                             <ul>
                                 <li><a href="{{route('user.home')}}">Home</a></li>
                                 @foreach (category_header() as $category)
                                 <li class=" @php
                                    if (isset($request->slug) && $request->slug == $category->slug) {
                                       echo "active";
                                    }
                                 @endphp">
                                    <a href="{{ route('user.products', $category->slug) }}">{{ $category->name }}</a>
                                 </li>
                              @endforeach
                                 {{-- <li><a href="#">women</a>
                                     <div>
                                         <div>
                                             <div>
                                                 <h3><a href="#">Accessories</a></h3>
                                                 <ul>
                                                     <li><a href="#">Cocktai</a></li>
                                                     <li><a href="#">day</a></li>
                                                     <li><a href="#">Evening</a></li>
                                                     <li><a href="#">Sundresses</a></li>
                                                     <li><a href="#">Belts</a></li>
                                                     <li><a href="#">Sweets</a></li>
                                                 </ul>
                                             </div>
                                             <div>
                                                 <h3><a href="#">HandBags</a></h3>
                                                 <ul>
                                                     <li><a href="#">Accessories</a></li>
                                                     <li><a href="#">Hats and Gloves</a></li>
                                                     <li><a href="#">Lifestyle</a></li>
                                                     <li><a href="#">Bras</a></li>
                                                     <li><a href="#">Scarves</a></li>
                                                     <li><a href="#">Small Leathers</a></li>
                                                 </ul>
                                             </div>
                                             <div>
                                                 <h3><a href="#">Tops</a></h3>
                                                 <ul>
                                                     <li><a href="#">Evening</a></li>
                                                     <li><a href="#">Long Sleeved</a></li>
                                                     <li><a href="#">Shrot Sleeved</a></li>
                                                     <li><a href="#">Tanks and Camis</a></li>
                                                     <li><a href="#">Sleeveless</a></li>
                                                     <li><a href="#">Sleeveless</a></li>
                                                 </ul>
                                             </div>
                                         </div>
                                         <div>
                                             <div>
                                                 <a href="#"><img src="assets\img\banner\banner1.jpg" alt=""></a>
                                             </div>
                                             <div>
                                                 <a href="#"><img src="assets\img\banner\banner2.jpg" alt=""></a>
                                             </div>
                                         </div>
                                     </div>
                                 </li>
                                 <li><a href="#">men</a>
                                     <div>
                                         <div>
                                             <div>
                                                 <h3><a href="#">Rings</a></h3>
                                                 <ul>
                                                     <li><a href="#">Platinum Rings</a></li>
                                                     <li><a href="#">Gold Ring</a></li>
                                                     <li><a href="#">Silver Ring</a></li>
                                                     <li><a href="#">Tungsten Ring</a></li>
                                                     <li><a href="#">Sweets</a></li>
                                                 </ul>
                                             </div>
                                             <div>
                                                 <h3><a href="#">Bands</a></h3>
                                                 <ul>
                                                     <li><a href="#">Platinum Bands</a></li>
                                                     <li><a href="#">Gold Bands</a></li>
                                                     <li><a href="#">Silver Bands</a></li>
                                                     <li><a href="#">Silver Bands</a></li>
                                                     <li><a href="#">Sweets</a></li>
                                                 </ul>
                                             </div>
                                             <div>
                                                 <a href="#"><img src="assets\img\banner\banner3.jpg" alt=""></a>
                                             </div>
                                         </div>

                                     </div>
                                 </li> --}}


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
