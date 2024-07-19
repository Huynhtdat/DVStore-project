<!--footer area start-->
<div class="footer_area">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_widget">
                        <h3>Thông tin liên hệ</h3>

                        <div class="footer_widget_contect">
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>{{ setting_website()->address }}</p>

                            <p><i class="fa fa-mobile" aria-hidden="true"></i> {{ setting_website()->phone_number }}</p>
                            <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{ setting_website()->email }} </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_widget">
                        <h3>Về chúng tôi</h3>
                        <p>Chuyên bán thời trang an toàn. Tin cậy nhanh chóng. Chăm sóc khách hàng 24/24.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_widget">
                        <h3>Các chức năng của bạn</h3>
                        <ul>
                            <li><a href="{{ route('profile.index') }}" title="My account">Tài khoản của bạn</a></li>
                            <li><a href="{{ route('order_history.index')}}">Lịch sử đặt hàng</a></li>
                            <li><a href="{{route('user.login')}}">Đăng nhập</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_widget">
                        <h3>Liện hệ</h3>
                        <form action="#" class="mt-3">
                            <div class="form-group">
                                <p for="emailInput">Đăng ký nhận bản tin của bạn</p>
                                <div class="input-group">
                                    <input id="emailInput" type="email" class="form-control" placeholder="Địa chỉ email của bạn" aria-label="Your email address" aria-describedby="subscribeButton">
                                </div>
                                <div class="input-group mt-3 w-50">
                                    <button class="btn btn-success btn-block" type="submit" id="subscribeButton">Gửi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="footer_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="copyright_area">
                        <ul>
                            <li><a href="#"> about us </a></li>
                            <li><a href="#">  Customer Service  </a></li>
                            <li><a href="#">  Privacy Policy  </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="footer_social text-right">
                        <ul>
                            <li><a href="#"><i class="fas fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fas fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fas fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-wifi" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
<!--footer area end-->
<!-- all js here -->
<script src="{{asset('assets\js\vendor\jquery-1.12.0.min.js')}}"></script>
<script src="{{asset('assets\js\popper.js')}}"></script>
<script src="{{asset('assets\js\bootstrap.min.js')}}"></script>
<script src="{{asset('assets\js\ajax-mail.js')}}"></script>
<script src="{{asset('assets\js\plugins.js')}}"></script>
<script src="{{asset('assets\js\main.js')}}"></script>
@vite(['resources/admin/js/toast-message.js'])
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Bootstrap core JavaScript==================================================-->



