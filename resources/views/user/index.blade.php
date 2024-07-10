@extends('layouts.user.main-client')
@section('content-client')

<!--pos home section-->
            <div class="pos_home_section">
                <div class="row">
                    <!--banner slider start-->
                    <div class="col-12">
                        <div class="banner_slider slider_two">
                            <div class="slider_active owl-carousel">
                                <div class="single_slider" style="background-image: url(assets/img/slider/slider_2.png)">
                                    <div class="slider_content">
                                        <div class="slider_content_inner">
                                            <h1>fashion for you</h1>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br> Cumque eligendi quia, ratione porro, nemo non.</p>
                                            <a href="#">shop now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="single_slider" style="background-image: url(assets/img/slider/slide_4.png)">
                                        <div class="slider_content">
                                        <div class="slider_content_inner">
                                            <h1>fashion for you</h1>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br> Cumque eligendi quia, ratione porro, nemo non.</p>
                                            <a href="#">shop now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="single_slider" style="background-image: url(assets/img/slider/slider_3.png)">
                                        <div class="slider_content">
                                        <div class="slider_content_inner">
                                            <h1>fashion for you</h1>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br> Cumque eligendi quia, ratione porro, nemo non.</p>
                                            <a href="#">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--banner slider start-->
                    </div>
                </div>
                    <!--new product area start-->
                <div class="new_product_area product_two">
                    <div class="row">
                        <div class="col-12">
                            <div class="block_title">
                            <h3>Sản phẩm mới</h3>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="single_p_active owl-carousel">
                            @foreach ( $newProducts as $newProduct )
                                <div class="col-lg-3">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                        <a href="{{ route('user.products_detail', $newProduct->id) }}"><img src="{{ asset("asset/client/images/products/small/$newProduct->img") }}" alt="Product"></a>
                                        <div class="img_icone">
                                            <img src="assets\img\cart\span-new.png" alt="">
                                        </div>
                                        <div class="product_action">

                                        </div>
                                        </div>
                                        <div class="product_content">
                                            <span class="product_price">{{ format_number_to_money($newProduct->price_sell) }} VNĐ</span>
                                            <h3 class="product_title"><a href="{{ route('user.products_detail', $newProduct->id) }}">{{ $newProduct->name }}</a></h3>
                                        </div>
                                        <div class="product_info">
                                            <ul>

                                                <li><a href="{{ route('user.products_detail', $newProduct->id) }}">Xem chi tiết</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--new product area start-->

                <!--banner area start-->
                <div class="banner_area banner_two">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="single_banner">
                                <a href="#"><img src="assets\img\banner\banner7.jpg" alt=""></a>
                                <div class="banner_title">
                                    <p>Up to <span> 40%</span> off</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single_banner">
                                <a href="#"><img src="assets\img\banner\banner8.jpg" alt=""></a>
                                <div class="banner_title title_2">
                                    <p>sale off <span> 30%</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single_banner">
                                <a href="#"><img src="assets\img\banner\banner11.jpg" alt=""></a>
                                <div class="banner_title title_3">
                                    <p>sale off <span> 30%</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--banner area end-->

                <!--featured product area start-->
                <div class="new_product_area product_two">
                    <div class="row">
                        <div class="col-12">
                            <div class="block_title">
                            <h3>Sản phẩm bán chạy</h3>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="single_p_active owl-carousel">
                            @foreach ($sellingProducts as $sellingProduct)
                                <div class="col-lg-3">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                        <a href="{{ route('user.products_detail', $sellingProduct->id) }}"><img src="{{ asset("asset/client/images/products/small/$sellingProduct->img") }}" alt="Product"></a>
                                        <div class="hot_img">
                                            <img src="assets\img\cart\span-hot.png" alt="">
                                        </div>
                                        <div class="product_action">

                                        </div>
                                        </div>
                                        <div class="product_content">
                                            <span class="product_price">{{ format_number_to_money($sellingProduct->price_sell) }} VNĐ</span>
                                            <h3 class="product_title"><a href="{{ route('user.products_detail', $sellingProduct->id) }}">{{ $sellingProduct->name }}</a></h3>
                                        </div>
                                        <div class="product_info">
                                            <ul>

                                                <li><a href="{{ route('user.products_detail', $sellingProduct->id) }}" >Xem chi tiết</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--featured product area start-->

                <!--blog area start-->
                {{-- <div class="blog_area blog_two">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="single_blog">
                                <div class="blog_thumb">
                                    <a href="blog-details.html"><img src="assets\img\blog\blog3.jpg" alt=""></a>
                                </div>
                                <div class="blog_content">
                                    <div class="blog_post">
                                        <ul>
                                            <li>
                                                <a href="#">Tech</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3><a href="blog-details.html">When an unknown took a galley of type.</a></h3>
                                    <p>Distinctively simplify dynamic resources whereas prospective core competencies. Objectively pursue multidisciplinary human capital for interoperable.</p>
                                    <div class="post_footer">
                                        <div class="post_meta">
                                            <ul>
                                                <li>Jun 20, 2018</li>
                                                <li>3 Comments</li>
                                            </ul>
                                        </div>
                                        <div class="Read_more">
                                            <a href="blog-details.html">Read more  <i class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single_blog">
                                <div class="blog_thumb">
                                    <a href="blog-details.html"><img src="assets\img\blog\blog4.jpg" alt=""></a>
                                </div>
                                <div class="blog_content">
                                    <div class="blog_post">
                                        <ul>
                                            <li>
                                                <a href="#">Men</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3><a href="blog-details.html">When an unknown took a galley of type.</a></h3>
                                    <p>Distinctively simplify dynamic resources whereas prospective core competencies. Objectively pursue multidisciplinary human capital for interoperable.</p>
                                    <div class="post_footer">
                                        <div class="post_meta">
                                            <ul>
                                                <li>Jun 20, 2018</li>
                                                <li>3 Comments</li>
                                            </ul>
                                        </div>
                                        <div class="Read_more">
                                            <a href="blog-details.html">Read more  <i class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single_blog">
                                <div class="blog_thumb">
                                    <a href="blog-details.html"><img src="assets\img\blog\blog1.jpg" alt=""></a>
                                </div>
                                <div class="blog_content">
                                    <div class="blog_post">
                                        <ul>
                                            <li>
                                                <a href="#">Women</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3><a href="blog-details.html">When an unknown took a galley of type.</a></h3>
                                    <p>Distinctively simplify dynamic resources whereas prospective core competencies. Objectively pursue multidisciplinary human capital for interoperable.</p>
                                    <div class="post_footer">
                                        <div class="post_meta">
                                            <ul>
                                                <li>Jun 20, 2018</li>
                                                <li>3 Comments</li>
                                            </ul>
                                        </div>
                                        <div class="Read_more">
                                            <a href="blog-details.html">Read more  <i class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> --}}
                <!--blog area end-->

                <!--brand logo strat-->
                {{-- <div class="brand_logo brand_two">
                    <div class="block_title">
                        <h3>Brands</h3>
                    </div>
                    <div class="row">
                        <div class="brand_active owl-carousel">
                            <div class="col-lg-2">
                                <div class="single_brand">
                                    <a href="#"><img src="assets\img\brand\brand1.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="single_brand">
                                    <a href="#"><img src="assets\img\brand\brand2.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="single_brand">
                                    <a href="#"><img src="assets\img\brand\brand3.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="single_brand">
                                    <a href="#"><img src="assets\img\brand\brand4.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="single_brand">
                                    <a href="#"><img src="assets\img\brand\brand5.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="single_brand">
                                    <a href="#"><img src="assets\img\brand\brand6.jpg" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!--brand logo end-->
            </div>
            <!--pos home section end-->
        </div>
        <!--pos page inner end-->
    </div>
</div>
<!--pos page end-->

@endsection()

