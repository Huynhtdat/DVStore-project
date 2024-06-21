@extends('layouts.user.main-client')
@section('content-client')
<!--pos home section-->
<div class=" pos_home_section">
    <div class="row pos_home">
        <div class="col-lg-3 col-md-8 col-12">
           <!--sidebar banner-->
            <div class="sidebar_widget banner mb-35">
                <div class="banner_img mb-35">
                    <a href="#"><img src="assets\img\banner\banner5.jpg" alt=""></a>
                </div>
                <div class="banner_img">
                    <a href="#"><img src="assets\img\banner\banner6.jpg" alt=""></a>
                </div>
            </div>
            <!--sidebar banner end-->

            <!--categorie menu start-->
            <div class="sidebar_widget catrgorie mb-35">
                <h3>Categories</h3>
                <ul>
                    <li class="has-sub"><a href="#"><i class="fa fa-caret-right"></i> women</a>
                        <ul class="categorie_sub">
                            <li><a href="#"><i class="fa fa-caret-right"></i> Accessories</a>
                                <ul class="categorie_sub">
                                    <li><a href="#"><i class="fa fa-caret-right"></i> Accessories</a></li>
                                    <li><a href="#"><i class="fa fa-caret-right"></i> Dresses</a></li>
                                    <li><a href="#"><i class="fa fa-caret-right"></i> Tops</a></li>
                                    <li><a href="#"><i class="fa fa-caret-right"></i> HandBags</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-caret-right"></i> Dresses</a></li>
                            <li><a href="#"><i class="fa fa-caret-right"></i> Tops</a></li>
                            <li><a href="#"><i class="fa fa-caret-right"></i> HandBags</a></li>
                        </ul>
                    </li>
                    <li class="has-sub"><a href="#"><i class="fa fa-caret-right"></i> Men</a>
                        <ul class="categorie_sub">
                            <li><a href="#"><i class="fa fa-caret-right"></i> Accessories</a>
                                <ul class="categorie_sub">
                                    <li><a href="#"><i class="fa fa-caret-right"></i> Accessories</a></li>
                                    <li><a href="#"><i class="fa fa-caret-right"></i> Dresses</a></li>
                                    <li><a href="#"><i class="fa fa-caret-right"></i> Tops</a></li>
                                    <li><a href="#"><i class="fa fa-caret-right"></i> HandBags</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-caret-right"></i> Dresses</a></li>
                            <li><a href="#"><i class="fa fa-caret-right"></i> Tops</a></li>
                            <li><a href="#"><i class="fa fa-caret-right"></i> HandBags</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--categorie menu end-->

            <!--wishlist block start-->
            <div class="sidebar_widget wishlist mb-35">
                <div class="block_title">
                    <h3><a href="#">Wishlist</a></h3>
                </div>


                <div class="block_content">
                    <p>Count:  product</p>
                    <a href="#">» My wishlists</a>
                </div>
            </div>
            <!--wishlist block end-->

            <!--popular tags area-->
            <div class="sidebar_widget tags mb-35">
                <div class="block_title">
                    <h3>brand tags</h3>
                </div>
                <div class="block_tags">
                    @foreach($brands as $brand)
                        <a href="#">{{ $brand->name }}</a>
                    @endforeach
                </div>
            </div>
            <!--popular tags end-->

            <!--newsletter block start-->
            <div class="sidebar_widget newsletter mb-35">
                <div class="block_title">
                    <h3>newsletter</h3>
                </div>
                <form action="#">
                    <p>Sign up for your newsletter</p>
                    <input placeholder="Your email address" type="text">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
            <!--newsletter block end-->



        </div>
        <div class="col-lg-9 col-md-12">
            <!--banner slider start-->
            <div class="banner_slider slider_1">
                <div class="slider_active owl-carousel">
                    <div class="single_slider" style="background-image: url(assets/img/slider/slide_1.png)">
                        <div class="slider_content">
                            <div class="slider_content_inner">
                                <h1>Women's Fashion</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                                <a href="#">shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="single_slider" style="background-image: url(assets/img/slider/slider_2.png)">
                        <div class="slider_content">
                            <div class="slider_content_inner">
                                <h1>New Collection</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                                <a href="#">shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="single_slider" style="background-image: url(assets/img/slider/slider_3.png)">
                        <div class="slider_content">
                            <div class="slider_content_inner">
                                <h1>Best Collection</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                                <a href="#">shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--banner slider start-->

            <!--new product area start-->
            <div class="new_product_area">
                <div class="block_title">
                    <h3>New Products</h3>
                </div>
                <div class="row">
                    <div class="product_active owl-carousel">
                    @foreach ( $newProducts as $newProduct )

                        <div class="col-lg-3">
                            <div class="single_product">
                                <div class="product_thumb">
                                   <a href="single-product.html"><img src="{{ asset("asset/client/images/products/small/$newProduct->img") }}" alt="Product"></a>
                                   <div class="img_icone">
                                       <img src="assets\img\cart\span-new.png" alt="">
                                   </div>
                                   <div class="product_action">
                                       <a href="#"> <i class="fa fa-shopping-cart"></i> Add to cart</a>
                                   </div>
                                </div>
                                <div class="product_content">
                                    <span class="product_price">{{ format_number_to_money($newProduct->price_sell) }} VNĐ</span>
                                    <h3 class="product_title"><a href="{{ route('user.products_detail', $newProduct->id) }}">{{ $newProduct->name }}</a></h3>
                                </div>
                                <div class="product_info">
                                    <ul>
                                        <li><a href="#" title=" Add to Wishlist ">Add to Wishlist</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#modal_box" >View Detail</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <!--new product area start-->

            <!--featured product start-->
            <div class="featured_product">
                <div class="block_title">
                    <h3>Best Selling Products</h3>
                </div>
                <div class="row">
                    <div class="product_active owl-carousel">
                        @foreach ($sellingProducts as $sellingProduct)
                        <div class="col-lg-3">
                            <div class="single_product">
                                <div class="product_thumb">
                                   <a href="single-product.html"><img src="{{ asset("asset/client/images/products/small/$sellingProduct->img") }}" alt="Product"></a>
                                   <div class="hot_img">
                                       <img src="assets\img\cart\span-hot.png" alt="">
                                   </div>
                                   <div class="product_action">
                                       <a href="#"> <i class="fa fa-shopping-cart"></i> Add to cart</a>
                                   </div>
                                </div>
                                <div class="product_content">
                                    <span class="product_price">{{ format_number_to_money($sellingProduct->price_sell) }} VNĐ</span>
                                    <h3 class="product_title"><a href="single-product.html">{{ $sellingProduct->name }}</a></h3>
                                </div>
                                <div class="product_info">
                                    <ul>
                                        <li><a href="#" title=" Add to Wishlist ">Add to Wishlist</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view">View Detail</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--featured product end-->

            <!--brand logo strat-->
            <div class="brand_logo mb-60">
                <div class="block_title">
                    <h3>Brands</h3>
                </div>
                <div class="row">
                    <div class="brand_active owl-carousel">
                        @foreach ($brands as $brand)
                        <div class="col-lg-2">
                            <div class="single_brand">
                                <a href="#"><img src="assets\img\brand\brand1.jpg" alt=""></a>
                                <a href="">{{ $brand->name}}</a>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>
            <!--brand logo end-->
        </div>
    </div>
</div>
<!--pos home section end-->
</div>
<!--pos page inner end-->
</div>
</div>
<!--pos page end-->

<!-- modal area start -->


<!-- modal area end -->

@endsection()

