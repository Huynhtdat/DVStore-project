@extends('layouts.user.main-client')
@section('content-client')
    <style>
        .product_options {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .product_options .sidebar_widget,
        .product_options .product_d_size,
        .product_options .product_stock {
            margin-bottom: 0;
        }
        .product_options select {
            width: 100px;
            padding: 5px;
            font-size: 14px;
        }
        .product_options .sidebar_widget label,
        .product_options .product_d_size label,
        .product_options .product_stock p {
            font-family: Arial, sans-serif;
            font-size: 16px;
            font-weight: bold;
            color: #333;
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
                    <li>Product Detail</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--product wrapper start-->
<div class="product_details">
    <div class="row">
        <div class="col-lg-5 col-md-6">
            <div class="product_tab fix">
                <div class="product_tab_button">
                    <ul class="nav" role="tablist">
                        <li>
                            <a class="active" data-toggle="tab" href="#p_tab1" role="tab" aria-controls="p_tab1" aria-selected="false"><img src="{{ asset("asset/client/images/products/small/$product->img") }}" alt=""></a>
                        </li>
                        @foreach ($productImage as $key => $image)
                        <li>
                            <a data-toggle="tab" href="#p_tab{{ $key + 2 }}" role="tab" aria-controls="p_tab{{ $key + 2 }}" aria-selected="false"><img src="{{ asset("asset/client/images/products/small/$image->img") }}" alt=""></a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-content produc_tab_c">
                    <div class="tab-pane fade show active" id="p_tab1" role="tabpanel">
                        <div class="modal_img">
                            <a href="#"><img src="{{ asset("asset/client/images/products/small/$product->img") }}" alt=""></a>
                            <div class="view_img">
                                <a class="large_view" href="{{ asset("asset/client/images/products/small/$product->img") }}"><i class="fa fa-search-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    @foreach ($productImage as $key => $image)
                    <div class="tab-pane fade" id="p_tab{{ $key + 2 }}" role="tabpanel">
                        <div class="modal_img">
                            <a href="#"><img src="{{ asset("asset/client/images/products/small/$image->img") }}" alt=""></a>
                            <div class="img_icone"></div>
                            <div class="view_img">
                                <a class="large_view" href="{{ asset("asset/client/images/products/small/$image->img") }}"><i class="fa fa-search-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-md-6">
            <div class="product_d_right">
                <h1>{{ $product->name }}</h1>
                <div class="avg-star">
                    <ul>
                        @for($i = 1; $i <= floor($avgRating); $i++)
                          <i class="fa fa-star"></i>
                        @endfor
                        @if (! is_int($avgRating))
                          <i class="fa fa-star-half-alt"></i>
                        @endif
                        <li><a href="#"> Da ban: {{ $productSold->sum ?? 0}} </a></li>
                    </ul>
                </div>
                <div class="product_desc">
                    <p>{!!$product->description!!}</p>
                </div>
                <div class="content_price mb-15">
                    <span>{{ format_number_to_money($product->price_sell)}} VND</span>
                </div>
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <div class="wided row">
                        <div class="col-md-3 wided-box mb-3">
                            <label for="data-color">Màu:</label>
                            <select id="data-color" class="form-control">
                                @foreach ($productColor as $color)
                                    <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 wided-box mb-3">
                            <label for="data-size">Size:</label>
                            <select id="data-size" data-sizes="{{ json_encode($productSize) }}" name="id" class="form-control"></select>
                        </div>
                        <div class="col-md-3 wided-box mb-3">
                            <div class="d-flex align-items-center h-100">
                                <span>Stock:</span>
                                <span id="quantity_remain" class="ml-2"></span>
                            </div>
                        </div>
                        <div class="col-md-3 wided-box mb-3">
                            <div class="d-flex align-items-center">
                                <span>Quantity:</span>
                                <input type="number" value="1" min="1" name="quantity" class="form-control ml-2" style="max-width: 70px;">
                            </div>
                        </div>
                        <div class="col-md-12 text-center mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button id="add-to-wishlist" data-product-id="{{ $product->id }}" class="btn btn-lg ml-2" style="color: red">
                                <i class="fa fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="wishlist-share">
                    <h4>Share on:</h4>
                    <ul>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                        <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product details end-->

<!--product info start-->
<div class="product_d_info">
    <div class="row">
        <div class="col-12">
            <div class="product_d_inner">
                <div class="product_info_button">
                    <ul class="nav" role="tablist">
                        <li>
                            <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Description</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Data sheet</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="info" role="tabpanel">
                        <div class="product_info_content">
                            <p>{!!$product->description!!}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sheet" role="tabpanel">
                        <div class="product_d_table">
                            <form action="#">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="first_child">Name</td>
                                            <td>{{ $product->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="first_child">Color</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="first_child">Size</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        @if (count($productReviews) > 0)
                        @foreach ($productReviews as $productReview)
                            <div class="product_info_inner">
                                <div class="product_ratting mb-10">
                                    <ul>
                                        <x-stars number="{{ $productReview->rating }}"/>
                                    </ul>
                                    <strong></strong>
                                    <p>{{ $productReview->created_at }}</p>
                                </div>
                                <div class="product_demo">
                                    <strong>{{ $productReview->user_name }}</strong>
                                    <p>{{ $productReview->content }}</p>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <p class="text-center review-comment-null">Chưa có đánh giá nào</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product info end-->

<!--new product area start-->
<div class="new_product_area product_page">
    <div class="row">
        <div class="col-12">
            <div class="block_title">
            <h3> Related Product </h3>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="single_p_active owl-carousel">
            @foreach ($relatedProducts as $relatedProduct)
            <div class="col-lg-3">
                <div class="single_product">
                    <div class="product_thumb">
                        <a href="single-product.html"><img src="{{ asset("asset/client/images/products/small/$relatedProduct->img") }}" alt=""></a>
                        <div class="img_icone">
                            <img src="" alt="">
                        </div>
                        <div class="product_action">
                            <a href="#"> <i class="fa fa-shopping-cart"></i> Add to cart</a>
                        </div>
                    </div>
                    <div class="product_content">
                        <span class="product_price">{{ format_number_to_money($relatedProduct->price_sell) }} VNĐ</span>
                        <h3 class="product_title"><a href="{{ route('user.products_detail', $relatedProduct->id) }}">{{ $relatedProduct->name }}</a></h3>
                    </div>
                    <div class="product_info">
                        <ul>
                            <li><a href="#" class="add-to-wishlist" data-product-id="{{ $relatedProduct->id }}" title="Add to Wishlist">Add to Wishlist</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modal_box" title="">View Detail</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!--new product area start-->

@vite(['resources/client/js/product-detail.js', 'resources/client/css/product-review.css'])

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('add-to-wishlist').addEventListener('click', function() {
            const productId = this.dataset.productId;
            fetch('{{ route('wishlist.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => alert(data.message));
        });

        document.querySelectorAll('.add-to-wishlist').forEach(function(button) {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                fetch('{{ route('wishlist.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(response => response.json())
                .then(data => alert(data.message));
            });
        });
    });
</script>

@endsection
