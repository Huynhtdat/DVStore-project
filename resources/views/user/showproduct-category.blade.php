@extends('layouts.user.main-client')
@section('content-client')

 <!--breadcrumbs area start-->
 <div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul>
                    <li><a href="{{route('user.home')}}">Home</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                        <li>shop</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->
<!--pos home section-->
<div class="pos_home_section">
    <div class="row pos_home">
        <form method="get">
            <div class="row">
                <div class="col-lg-3" >
                    <!-- Category Section -->
                    <div class="sidebar_widget shop_c " style="margin-left: 2rem;" >
                        <div class="categorie__titile">
                            <h4>Category</h4>
                        </div>
                        <div class="layere_categorie">
                            <ul>
                                @foreach ($categories as $category)
                                <li>
                                    <input type="checkbox" class="checkboxx" value="{{ $category->slug }}" {{ ($categorySlug == $category->slug) ? 'checked' : '' }} name="category_slug">
                                    <label for="acces" class="name-filter">{{ $category->name }}</label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- Category Section End -->

                    <!-- Brand Section -->
                    <div class="sidebar_widget shop_c" style="margin-left: 2rem;">
                        <div class="categorie__titile">
                            <h4>Brand</h4>
                        </div>
                        <div class="layere_categorie">
                            <ul>
                                <li>
                                    <input type="checkbox" class="checkboxx" value="" name="brand_id" {{ ($request->brand_id == '') ? 'checked' : '' }}>
                                    <label for="acces" class="name-filter"> All </label>
                                </li>
                                @foreach ($brands as $brand)
                                <li>
                                    <input type="checkbox" class="checkboxx" value="{{ $brand->id }}" {{ ($request->brand_id == $brand->id) ? 'checked' : '' }} name="brand_id">
                                    <label for="acces" class="name-filter">{{ $brand->name }}</label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- Brand Section End -->

                    <!-- Price Filter Section -->
                    <div class="price-filter leftbar" style="width:100%; magin-left: 2rem;">
                        <h3 class="title">Price</h3>
                        <div style="display: flex; width: 100%;">
                            <input id="min-price" type="text" value="{{ $request->min_price ?? '' }}" class="form-control price-filter" placeholder="From" name="min_price">
                            <span class="separate">-</span>
                            <input id="max-price" type="text" value="{{ $request->max_price ?? '' }}" class="form-control price-filter" placeholder="To" name="max_price">
                        </div>
                    </div>
                    <!-- Price Filter Section End -->

                    <!-- Filter Button -->
                    <div style="display: flex; width: 100%; margin-top: 10px; justify-content: center;">
                        <button id="filter-price" url="{{ $request->fullUrl() }}">filter</button>
                    </div>
                </div>

                <div class="col-lg-9">
                <!--shop tab product-->
                <div class="shop_tab_product">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="large" role="tabpanel">
                            <div class="row">
                                @if (count($products) > 0)
                                    @foreach ($products as $product)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a href="{{ route('user.products_detail', $product->id) }}">
                                                    <img src="{{ asset("asset/client/images/products/small/$product->img") }}" alt=""></a>
                                                <div class="product_action">
                                                    <a href=""> <i class="fa fa-shopping-cart"></i> Add to cart</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <span class="product_price">{{ format_number_to_money($product->price_sell) }} VNĐ</span>
                                                <h3 class="product_title"><a href="{{ route('user.products_detail', $product->id) }}">
                                                    {{ $product->name }}</a></h3>
                                            </div>
                                            <div class="product_info">
                                                <ul>
                                                    <li><a href="#" title=" Add to Wishlist ">Add to Wishlist</a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#modal_box" title="">View Detail</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <h3 class="title" style="padding-top: 20px;">Không tìm thấy sản phẩm</h3>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade show active" id="list" role="tabpanel">
                            <div class="product_list_item mb-35">
                                <div class="row align-items-center">
                                    @if (count($products) > 0)
                                        @foreach ($products as $product)
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="product_thumb">
                                                <a href="{{ route('user.products_detail', $product->id)}}"><img src="{{ asset("asset/client/images/products/small/$product->img") }}" alt=""></a>
                                                <div class="hot_img">
                                                    <img src="{{ asset("asset/client/images/products/small/$product->img") }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6 col-sm-6">
                                            <div class="list_product_content">
                                                <div class="product_ratting">
                                                    <x-avg-stars :number="$product->avg_rating" />
                                                </div>
                                                <div class="list_title">
                                                    <h3><a href="{{ route('user.products_detail', $product->id) }}">{{$product->name}}</a></h3>
                                                </div>
                                                <p class="design">{{ $product->description }}</p>

                                                <div class="content_price">
                                                    <span>{{ $product->price_sell }}</span>
                                                </div>
                                                <div class="add_links">
                                                    <ul>
                                                        <li><a href="#" title="add to cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                                        <li><a href="#" title="add to wishlist"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                                        <li><a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                    @endif
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<!--pos home section end-->


@vite(['resources/client/js/show-product.js', 'resources/client/css/product-review.css'])
@endsection
