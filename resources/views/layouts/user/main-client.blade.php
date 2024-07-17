<!DOCTYPE html>
<html lang="en">
    <!--pos page start-->
    <div class="pos_page">
        <div class="container">
           <!--pos page inner-->
            <div class="pos_page_inner">
                @include('layouts.user.header')
                @yield('content-client')

            </div>

            <!--pos page inner end-->
            @include('layouts.user.footer')
        </div>

    </div>
    <!--pos page end-->
    @if (Session::has('success'))
        <span id="toast__js" message="{{ session('success') }}" type="success"></span>
    @elseif (Session::has('error'))
         <span id="toast__js" message="{{ session('error') }}" type="error"></span>
    @endif

@vite(['resources/admin/js/toast-message.js'])
</html>
