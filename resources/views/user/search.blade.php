@extends('layouts.user.main-client')

@section('content-client')
<div class="container_fullwidth" style="min-height: calc(100vh - 389px);">
    <div class="container">
        <div class="hot-products">
            <h3 class="title">
                @if (count($products) > 0)
                    Kết quả tìm kiếm cho từ khoá '<span style="color:#f7544a;">{{ $contentSearch }}</span>'
                @else
                    Chúng tôi không tìm thấy sản phẩm '<span style="color:#f7544a;">{{ $contentSearch }}</span>' nào
                @endif
            </h3>
            {{-- <form class="row" method="GET">
                <input type="text" value="{{ $contentSearch }}" hidden name="keyword">
                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control form-select" name="category">
                            <option disabled selected>Chọn danh mục</option>
                            <option value="" >Tất cả</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control form-select" name="brand">
                            <option disabled selected>Chọn thương hiệu</option>
                            @foreach ($brands as $item)
                                <option value="{{ $item->id }}" {{ ($item->id == $brand) ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group" style="display: flex; align-items: center;">
                        <input type="text" class="form-control price-filter" value="{{ $minPrice }}" placeholder="Giá từ" name="min_price">
                        <span style="border-top: 1px; width: 50px;"></span>
                        <input type="text" class="form-control price-filter" value="{{ $maxPrice }}" placeholder="Giá đến" name="max_price">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <button class="price-filter">Lọc tìm kiếm</button>
                    </div>
                </div>
            </form> --}}
            <ul>
                <li>
                <div class="row">
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6">
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a href="{{ route('user.products_detail', $product->id) }}">
                                        <img src="{{ asset("asset/client/images/products/small/$product->img") }}" alt=""></a>
                                    <div class="product_action">
                                        <a href=""> <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <span class="product_price">{{ format_number_to_money($product->price_sell) }} VNĐ</span>
                                    <h3 class="product_title"><a href="{{ route('user.products_detail', $product->id) }}">
                                        {{ $product->name }}</a></h3>
                                </div>
                                <div class="product_info">
                                    <ul>
                                        <li><a href="#" title=" Add to Wishlist ">Thêm vào danh sách yêu thích</a></li>
                                        <li><a href="{{ route('user.products_detail', $newProduct->id) }}" data-toggle="modal" data-target="#modal_box" title="">View Detail</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <h3 class="title" style="padding-top: 20px;">Không tìm thấy sản phẩm</h3>
                    @endif
                </div>
                </li>
            </ul>
        </div>
        <div class="text-center">
            <ul class="pagination">
                {{ $products->links('vendor.pagination-default') }}
            </ul>
        </div>
    </div>
</div>
@vite(['resources/client/css/search.css'])
@endsection
