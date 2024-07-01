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
        </div>
    </div>
    <!--pos page end-->

    @include('layouts.user.footer')
</html>
