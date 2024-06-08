<div class="footer">
    <div class="footer-info">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-logo">
                        <a href="{{ route('user.home') }}">
                            <img src="{{ asset("asset/client/images/" . setting_website()->logo) }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4 class="title">Thông tin liên hệ</h4>
                    <p>{{ setting_website()->address }}</p>
                    <p>Số điện thoại : {{ setting_website()->phone_number }}</p>
                    <p>Email : {{ setting_website()->email }}</p>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4 class="title">Về chúng tôi</h4>
                    <p>Chuyên bán thời trang an toàn. Tin cậy nhanh chóng. Chăm sóc khách hàng 24/24</p>
                </div>
                <div class="col-md-3">
                    <h4 class="title">Nhận thông tin từ chúng tôi</h4>
                    <p>Cảm ơn rất nhiều</p>
                    <form class="newsletter">
                        <input type="text" name="" placeholder="Email của bạn">
                        <input type="submit" value="Gửi" class="button">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@if (Session::has('success'))
<span id="toast__js" message="{{ session('success') }}" type="success"></span>
@elseif (Session::has('error'))
<span id="toast__js" message="{{ session('error') }}" type="error"></span>
@endif
<!-- Bootstrap core JavaScript==================================================-->
<script src="{{ asset('asset/admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('asset/admin/plugins/jquery-validation/jquery.validate.js') }}"></script>
<script type="text/javascript" src="{{ asset('asset/client/js/jquery-1.10.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('asset/client/js/jquery.easing.1.3.js') }}"></script>
<script type="text/javascript" src="{{ asset('asset/client/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('asset/client/js/jquery.sequence-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('asset/client/js/jquery.carouFredSel-6.2.1-packed.js') }}"></script>
<script type="text/javascript" src="{{ asset('asset/client/js/script.min.js') }}"></script>
<script defer src="{{ asset('asset/client/js/jquery.flexslider.js') }}"></script>
@vite(['resources/admin/js/toast-message.js'])
</body>
</html>
