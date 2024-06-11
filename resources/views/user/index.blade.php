@extends('layouts.user.main-client')
@section('content-client')
<div class="container_fullwidth">
    <div class="container">
        <div class="hot-products">
            <h3 class="title">Best Selling  </h3>
            <div class="control"></div>
            <ul>
                <li>
                <div class="row">
                    @foreach ($sellingProducts as $sellingProduct)
                    <div class="col-md-3 col-sm-6">
                        <div class="products">
                            <div class="offer">Bán Chạy</div>
                            <div class="thumbnail">
                                <a href=""><img src="{{ asset("asset/client/images/products/small/$sellingProduct->img") }}" alt="Product Name"></a>
                            </div>
                            <div class="productname" style="height: 42px;">{{ $sellingProduct->name }}</div>
                            <h4 class="price">{{ format_number_to_money($sellingProduct->price_sell) }} VNĐ</h4>
                            <div class="productname" style="padding-bottom: 10px; padding-top: unset;">
                                <x-avg-stars :number="$sellingProduct->avg_rating" />
                                <span style="font-size: 14px;">Đã bán: {{ $sellingProduct->sum }}</span>
                            </div>
                            <div class="button_group"><a href="" class="button add-cart" type="button">Xem Chi Tiết</a></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="featured-products">
            <h3 class="title">Sản Phẩm Mới Nhất</h3>
            <div class="control"></div>
            <ul>
                <li>
                <div class="row">
                    @foreach ($newProducts as $newProduct)
                        <div class="col-md-3 col-sm-6">
                            <div class="products">
                                <div class="offer">Mới Nhất</div>
                                <div class="thumbnail"><a href=""><img src="{{ asset("asset/client/images/products/small/$newProduct->img") }}" alt="Product Name"></a></div>
                                <div class="productname" style="height: 42px;">{{ $newProduct->name }}</div>
                                <h4 class="price">{{ format_number_to_money($newProduct->price_sell) }} VNĐ</h4>
                                <div class="productname" style="padding-bottom: 10px; padding-top: unset;">
                                    <x-avg-stars :number="$newProduct->avg_rating" />
                                    <span style="font-size: 14px;">Đã bán: {{ $newProduct->sum }}</span>
                                </div>
                                <div class="button_group"><a href="" class="button add-cart" type="button">Xem Chi Tiết</a></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection()

