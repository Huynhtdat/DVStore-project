@extends('layouts.user.main-client')
@section('content-client')

 <!--breadcrumbs area start-->
 <div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul>
                    <li><a href="{{route('user.home')}}">Trang chủ</a></li>
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
                            <h4 class="title">Danh mục</h4>
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
                            <h4 class="title">Thương hiệu</h4>
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
                    <div class="price-filter leftbar" style="width: 100%; margin-left: 2rem;">
                        <h4 class="title">Price</h4>
                        <div class="d-flex">
                            <input id="min-price" type="text" value="{{ $request->min_price ?? '' }}" class="form-control mr-2" placeholder="From" name="min_price">
                            <span class="separate">_</span>
                            <input id="max-price" type="text" value="{{ $request->max_price ?? '' }}" class="form-control ml-2" placeholder="To" name="max_price">
                        </div>
                    </div>

                    <!-- Price Filter Section End -->

                    <!-- Filter Button -->
                    <div class="d-flex justify-content-center mt-3">
                        <button id="filter-price" url="{{ $request->fullUrl() }}" class="btn btn-primary">Lọc sản phẩm</button>
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

                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <span class="product_price">{{ format_number_to_money($product->price_sell) }} VNĐ</span>
                                                <h3 class="product_title"><a href="{{ route('user.products_detail', $product->id) }}">
                                                    {{ $product->name }}</a></h3>
                                            </div>
                                            <div class="product_info">
                                                <ul>
                                                    <li><a href="{{ route('user.products_detail', $product->id) }}" title="">Xem chi tiết</a></li>
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
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<!--pos home section end-->


@vite(['resources/client/js/show-product.js', 'resources/client/css/product-review.css'])
@endsection
