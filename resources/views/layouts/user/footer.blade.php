<!--footer area start-->
<div class="footer_area">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_widget">
                        <h3>Contact Info</h3>

                        <div class="footer_widget_contect">
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>{{ setting_website()->address }}</p>

                            <p><i class="fa fa-mobile" aria-hidden="true"></i> {{ setting_website()->phone_number }}</p>
                            <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{ setting_website()->email }} </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_widget">
                        <h3>About Us</h3>
                        <p>Chuyên bán thời trang an toàn. Tin cậy nhanh chóng. Chăm sóc khách hàng 24/24.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_widget">
                        <h3>My Account</h3>
                        <ul>
                            <li><a href="#">Your Account</a></li>
                            <li><a href="{{ route('order_history.index')}}">History orders</a></li>
                            <li><a href="{{route('user.login')}}">Login</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_widget">
                        <h3>Contact</h3>
                        <form action="#">
                            <p>Sign up for your newsletter</p>
                            <input placeholder="Your email address" type="text">
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
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
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-wifi" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer area end-->
<!-- all js here -->
<script src="{{asset('assets\js\vendor\jquery-1.12.0.min.js')}}"></script>
<script src="{{asset('assets\js\popper.js')}}"></script>
<script src="{{asset('assets\js\bootstrap.min.js')}}"></script>
<script src="{{asset('assets\js\ajax-mail.js')}}"></script>
<script src="{{asset('assets\js\plugins.js')}}"></script>
<script src="{{asset('assets\js\main.js')}}"></script>

<!-- Bootstrap core JavaScript==================================================-->



