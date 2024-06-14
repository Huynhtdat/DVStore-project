<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ setting_website()->name }}</title>
    <meta name="description" content="Online Shopping Site">
    <meta name="keywords" content="shopping, ecommerce, online store">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="{{ asset('asset/client/images/favicon.png') }}">

    <!-- CSS Files -->
    <link href="{{ asset('asset/client/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/client/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/client/css/flexslider.css') }}" type="text/css" media="screen"/>
    <link href="{{ asset('asset/client/css/sequence-looptheme.css') }}" rel="stylesheet" media="all"/>
    <link href="{{ asset('asset/client/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/admin/plugins/fontawesome-free/css/all.min.css') }}">
    @vite(['resources/client/css/auth.css', 'resources/client/css/home.css'])

    <!-- JS Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('asset/client/js/jquery.flexslider-min.js') }}"></script>
    <script src="{{ asset('asset/client/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset/client/js/custom.js') }}"></script>
</head>
<body class="home">
    <div class="wrapper">
        <div class="header">
            <div class="container">
                <div class="header_top">
                    <div class="logo">
                        <a href="{{ route('user.home') }}">
                            <img src="{{ asset('asset/client/images/' . setting_website()->logo) }}" alt="Logo">
                        </a>
                    </div>
                    <div class="nav-options">
                        @if (Auth::check())
                        <ul class="usermenu">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle profile">
                                    <img src="{{ asset('asset/client/images/loginbg.png') }}" alt="Profile">
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="#">Purchase history</a></li>
                                    <li><a href="#">LogOut</a></li>
                                </ul>
                            </li>
                        </ul>
                        @else
                        <ul class="usermenu">
                            <li><a href="{{ route('user.login') }}" class="log">Login</a></li>
                            <li><a href="{{ route('user.register') }}" class="reg">Register</a></li>
                        </ul>
                        @endif
                        <ul class="option">
                            <li id="search" class="search">
                                <form method="GET" action="#">
                                    <input class="search-input" placeholder="Enter your search term..." type="text" name="keyword">
                                    <input class="search-submit" type="submit" value="">
                                </form>
                            </li>
                            <li class="option-cart">
                                <a href="#" class="cart-icon">cart <span class="cart_no">0</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <nav class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown {{ (request()->is('/*')) ? 'active' : '' }}">
                            <a href="{{ route('user.home') }}">Trang Chủ</a>
                        </li>
                        @foreach (category_header() as $category)
                        <li class="dropdown @php if (isset($request->slug) && $request->slug == $category->slug) { echo "active"; } @endphp">
                            <a href="#">{{ $category->name }}</a>
                        </li>
                        @endforeach
                        <li class="dropdown {{ (request()->is('introduction*')) ? 'active' : '' }}">
                            <a href="#">Giới Thiệu</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>
