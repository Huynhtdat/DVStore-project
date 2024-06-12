<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Your website description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('asset/client/images/favicon.png') }}">
    <title>{{ setting_website()->name }}</title>
    <link href="{{ asset('asset/client/css/bootstrap.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset/client/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/client/css/flexslider.css') }}" type="text/css" media="screen"/>
    <link href="{{ asset('asset/client/css/sequence-looptheme.css') }}" rel="stylesheet" media="all"/>
    <link href="{{ asset('asset/client/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/admin/plugins/fontawesome-free/css/all.min.css') }}">
    @vite(['resources/client/css/auth.css', 'resources/client/css/home.css'])
</head>
<body>
    @include('layouts.user.header')
    <main>
        @yield('content')
    </main>
    @include('layouts.user.footer')
</body>
</html>
