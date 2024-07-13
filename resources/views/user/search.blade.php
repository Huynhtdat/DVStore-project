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

                                    </div>
                                </div>
                                <div class="product_content">
                                    <span class="product_price">{{ format_number_to_money($product->price_sell) }} VNĐ</span>
                                    <h3 class="product_title"><a href="{{ route('user.products_detail', $product->id) }}">
                                        {{ $product->name }}</a></h3>
                                </div>
                                <div class="product_info">
                                    <ul>

                                        <li><a href="{{ route('user.products_detail', $product->id) }}" data-toggle="modal" data-target="#modal_box" title="">View Detail</a></li>
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
