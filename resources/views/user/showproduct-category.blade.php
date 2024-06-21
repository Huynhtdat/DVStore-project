@extends('layouts.user.main-client')
@section('content-client')
<style>

    .separate {
        float: left;
        margin: 0 5px 0 5px;
        font-size: 24px;
        font-weight: 700;
        color: #bfbfbf;
    }
    .checkboxx {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border: 1px solid #ccc;
        border-radius: 0;
        width: 14px;
        height: 14px;
        outline: none;
        cursor: pointer;
    }

    .checkboxx:checked::before {
    content: "\2713";
    display: inline-block;
    text-align: center;
    font-size: 12px;
    width: 14px;
    height: 14px;
    line-height: 14px;
    color: #fff;
    background-color: #007bff;
    border: 2px solid #007bff;
    }

    .name-filter{
        display: inline !important;
        margin-top: 1px;
    }

    .checkboxx:focus{
        outline: none !important;
        outline: none !important;
        outline-offset: unset !important;
    }
</style>
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
    <div class=" pos_home_section">
        <div class="row pos_home">
                <div class="col-lg-3 col-md-12">
                   <!--layere categorie"-->
                      <div class="sidebar_widget shop_c">
                            <div class="categorie__titile">
                                <h4>Categories</h4>
                            </div>
                            <div class="layere_categorie">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li>
                                            <input id="acces" type="checkbox" value="{{ $category->slug }}" {{ ($categorySlug == $category->slug) ? 'checked' : '' }} name="category_slug">
                                            <label for="acces">{{ $category->name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    <!--layere categorie end-->

                    <!--brand area start-->
                    <div class="sidebar_widget shop_c">
                        <div class="categorie__titile">
                            <h4>Brand</h4>
                        </div>
                        <div class="layere_categorie">
                            <ul>
                                @foreach ($brands as $brand)
                                    <li>
                                        <input id="acces" type="checkbox" value="{{ $brand->id }}" {{ ($request->brand_id == $brand->id) ? 'checked' : '' }} name="brand_id">
                                        <label for="acces">{{ $brand->name }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--brand area end-->

                    <!--price slider start-->
                    <div class="price-filter leftbar" style="width:100%;">
                        <h3 class="title">
                            Price
                        </h3>
                        <div style="display: flex; width: 100%;">
                            <input id="min-price" type="text" value="{{ $request->min_price ?? '' }}" class="form-control price-filter" placeholder="Giá từ" name="min_price">
                            <span class="separate">-</span>
                            <input id="max-price" type="text" value="{{ $request->max_price ?? '' }}" class="form-control price-filter" placeholder="Giá đến" name="max_price">
                        </div>
                    </div>
                    <!--price slider end-->
                    <div style="display: flex; width: 100%; margin-top: 10px; justify-content: center;">
                        <button id="filter-price" url="{{ $request->fullUrl() }}">Lọc Sản Phẩm</button>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">

                    <!--shop toolbar start-->
                    <div class="shop_toolbar list_toolbar mb-35">
                        <div class="list_button">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a data-toggle="tab" href="#large" role="tab" aria-controls="large" aria-selected="true"><i class="fa fa-th-large"></i></a>
                                </li>
                                <li>
                                    <a class="active" data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="false"><i class="fa fa-th-list"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="page_amount">
                            <p>Showing 1–9 of 21 results</p>
                        </div>

                    </div>
                    <!--shop toolbar end-->

                    <!--shop tab product-->
                    <div class="shop_tab_product">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade " id="large" role="tabpanel">
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
                                                    <span class="product_price">{{ $product->price_sell }}</span>
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
                            <div class="tab-pane fade show active" id="list" role="tabpanel">
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
                                                        {{-- <span class="old-price">$130.00</span> --}}
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
                            </div>

                        </div>
                    </div>
                    <!--shop tab product end-->

                    <!--pagination style start-->
                    <div class="pagination_style">
                        <div class="item_page">
                            <form action="#">
                                <label for="page_select">show</label>
                                <select id="page_select">
                                    <option value="1">9</option>
                                    <option value="2">10</option>
                                    <option value="3">11</option>
                                </select>
                                <span>Products by page</span>
                            </form>
                        </div>
                        <div class="page_number">
                            <span>Pages: </span>
                            <ul>
                                <li>«</li>
                                <li class="current_number">1</li>
                                <li><a href="#">2</a></li>
                                <li>»</li>
                            </ul>
                        </div>
                    </div>
                    <!--pagination style end-->
                </div>
            </div>
    </div>
    <!--pos home section end-->
</div>
<!--pos page inner end-->
</div>
</div>
<!--pos page end-->

{{-- <div class="container_fullwidth">
    <div class="container">
        <div class="row">
            <form method="get">
                <div class="col-md-3">
                    <div class="category leftbar">
                    <h3 class="title">
                        Danh Mục Sản Phẩm
                    </h3>
                    <ul>
                        @foreach ($categories as $category)
                            <li>
                                <input type="radio" class="checkboxx" value="{{ $category->slug }}" {{ ($categorySlug == $category->slug) ? 'checked' : '' }} name="category_slug">
                                <a class="name-filter">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    </div>
                    <div class="clearfix">
                    </div>
                    <div class="branch leftbar">
                        <h3 class="title">
                            Thương hiệu
                        </h3>
                        <ul>
                            <li>
                                <input type="radio" class="checkboxx" value="" name="brand_id" {{ ($request->brand_id == '') ? 'checked' : '' }}>
                                <a class="name-filter">
                                    Tất cả
                                </a>
                            </li>
                            @foreach ($brands as $brand)
                                <li>
                                    <input type="radio" class="checkboxx" value="{{ $brand->id }}" {{ ($request->brand_id == $brand->id) ? 'checked' : '' }} name="brand_id">
                                    <a class="name-filter">
                                        {{ $brand->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="clearfix">
                    </div>
                    <div class="price-filter leftbar" style="width:100%;">
                        <h3 class="title">
                            Khoảng Giá
                        </h3>
                        <div style="display: flex; width: 100%;">
                            <input id="min-price" type="text" value="{{ $request->min_price ?? '' }}" class="form-control price-filter" placeholder="Giá từ" name="min_price">
                            <span class="separate">-</span>
                            <input id="max-price" type="text" value="{{ $request->max_price ?? '' }}" class="form-control price-filter" placeholder="Giá đến" name="max_price">
                        </div>
                    </div>
                    <div style="display: flex; width: 100%; margin-top: 10px; justify-content: center;">
                        <button id="filter-price" url="{{ $request->fullUrl() }}">Lọc Sản Phẩm</button>
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
            </form>
            <div class="col-md-9">
                <div class="products-grid">
                    <div class="row">
                        @if (count($products) > 0)
                            @foreach ($products as $product)
                                <div class="col-md-4 col-sm-6">
                                    <div class="products">
                                        <div class="thumbnail">
                                            <a href="{{ route('user.products_detail', $product->id) }}">
                                                <img src="{{ asset("asset/client/images/products/small/$product->img") }}" alt="Product Name">
                                            </a>
                                        </div>
                                        <div class="productname" style="height: 42px;">
                                            <a href="{{ route('user.products_detail', $product->id) }}">{{ $product->name }}</a>
                                        </div>
                                        <h4 class="price">
                                            {{ format_number_to_money($product->price_sell) }}
                                        </h4>
                                        <div class="productname" style="padding-bottom: 10px; padding-top: unset;">
                                            <x-avg-stars :number="$product->avg_rating" />
                                            <span style="font-size: 14px;">Đã bán: {{ $product->sum }}</span>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @else
                        <h3 class="title" style="padding-top: 20px;">Không tìm thấy sản phẩm</h3>
                        @endif
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
                @if (count($products) > 0)
                <div class="text-center">
                    <ul class="pagination">
                        {{ $products->links('vendor.pagination-default') }}
                    </ul>
                </div>
                @endif
            </div>
            <div class="clearfix">
            </div>
        </div>
    </div>
</div> --}}
@vite(['resources/client/js/show-product.js', 'resources/client/css/product-review.css'])
@endsection
