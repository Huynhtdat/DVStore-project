<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('asset/client/images/favicon.png') }}">
    <title>{{ setting_website()->name }}</title>
    <link href="{{ asset('asset/client/css/bootstrap.css') }}" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
    <link href="{{ asset('asset/client/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/client/css/flexslider.css') }}" type="text/css" media="screen"/>
    <link href="{{ asset('asset/client/css/sequence-looptheme.css') }}" rel="stylesheet" media="all"/>
    <link href="{{ asset('asset/client/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/admin/plugins/fontawesome-free/css/all.min.css') }}">
    @vite(['resources/client/css/auth.css', 'resources/client/css/home.css'])

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- FlexSlider -->
    <script src="{{ asset('asset/client/js/jquery.flexslider-min.js') }}"></script>
</head>

<body class="home">
    <div class="wrapper">
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-2">
                        <div class="logo">
                            <a href="{{ route('user.home') }}">
                                <img src="{{ asset("asset/client/images/" . setting_website()->logo) }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-10 col-sm-10">
                        <div class="header_top">
                            <div class="row">
                                <div class="col-md-6">
                                    @if (Auth::check())
                                    <ul class="nav navbar-nav usermenu">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle profile" data-toggle="dropdown">
                                                <img src="{{ asset('asset/client/images/loginbg.png') }}" alt="">
                                                <span>{{ Auth::user()->name }}</span>
                                            </a>
                                            <div class="dropdown-menu">
                                                <ul class="mega-menu-links">
                                                    {{-- route profile --}}
                                                    <li><a href="#">Profile</a></li>
                                                    {{-- route lịch sử đơn hàng --}}
                                                    <li><a href="#">Purchase history</a></li>
                                                    {{-- route logout --}}
                                                    <li><a href="#">LogOut</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                    @else
                                    <ul class="usermenu">
                                        <li><a href="{{ route('user.login') }}" class="log">Login</a></li>
                                        <li><a href="{{ route('user.register') }}" class="reg">Register</a></li>
                                    </ul>
                                    @endif
                                </div>
                                <ul class="option">
                                    <li id="search" class="search">
                                        {{-- thêm route search ngay tại đây --}}
                                        <form method="GET" action="#">
                                            <input class="search-submit" type="submit" value="">
                                            <input class="search-input" placeholder="Enter your search term..." type="text" value="" name="keyword">
                                        </form>
                                    </li>
                                    <li class="option-cart">
                                        {{-- thêm route giỏ hàng tại đây --}}
                                        <a href="#" class="cart-icon">cart <span class="cart_no"></span></a>
                                    </li>
                                </ul>
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="navbar-collapse collapse">
                                    <ul class="nav navbar-nav">
                                        <li class="dropdown {{ (request()->is('/*')) ? 'active' : '' }}">
                                            <a href="{{ route('user.home') }}">Trang Chủ</a>
                                        </li>
                                        @foreach (category_header() as $category)
                                        <li class="dropdown @php if (isset($request->slug) && $request->slug == $category->slug) { echo "active"; } @endphp">
                                            {{-- thêm route product (thêm id) --}}
                                            <a href="#">{{ $category->name }}</a>
                                        </li>
                                        @endforeach
                                        <li class="dropdown {{ (request()->is('introduction*')) ? 'active' : '' }}">
                                            {{-- thêm route giới thiệu cửa hàng tại đây --}}
                                            <a href="#">Giới Thiệu</a>
                                        </li>
                                    </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
