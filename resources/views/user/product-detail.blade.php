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
                    <li><a href="{{route('user.home')}}">Trang chủ</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>Chi tiết sản phẩm</li>
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
                        <h4 class="number-avg-star">{{ number_format($avgRating, 1) }}/5</h4>
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
                        <div class="col-md-3 wided-box mb-3 d-flex align-items-center">
                            <label for="data-color" class="mb-0 mr-2"><strong>Màu:</strong></label>
                            <select id="data-color" class="form-control">
                                @foreach ($productColor as $color)
                                    <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 wided-box mb-3 d-flex align-items-center">
                            <label for="data-size" class="mb-0 mr-2"><strong>Kích thước:</strong></label>
                            <select id="data-size" data-sizes="{{ json_encode($productSize) }}" name="id" class="form-control">
                            </select>
                        </div>
                        <div class="col-md-3 wided-box mb-3">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <span class="mr-2"><strong>Tồn kho:</strong></span>
                                <span id="quantity_remain"></span>
                            </div>
                        </div>
                        <div class="col-md-3 wided-box mb-3">
                            <div class="d-flex align-items-center">
                                <span><strong>Sô lượng:</strong></span>
                                <input type="number" value="1" min="1" name="quantity" class="form-control ml-2" style="max-width: 70px;">
                            </div>
                        </div>
                        <div class="col-md-12 text-center mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
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
                            <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Mô tả sản phẩm</a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Đánh giá</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="info" role="tabpanel">
                        <div class="product_info_content">
                            <p>{!!$product->description!!}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-review" role="tabpanel">
                        <div class="product_review_form">
                            <form action="#">
                                <h2>Add a review </h2>
                                <p>Your email address will not be published. Required fields are marked </p>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="review_comment">Your review </label>
                                        <textarea name="comment" id="review_comment"></textarea>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="author">Name</label>
                                        <input id="author" type="text">

                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="email">Email </label>
                                        <input id="email" type="text">
                                    </div>
                                </div>
                                <button type="submit">Submit</button>
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
                        <div class="product_review_form">
                            <form method="POST" action="{{ route('product_review.store', $product->id) }}">
                                @csrf
                                <div class="row">
                                  @if ($checkReviewProduct)
                                    <div class="col-md-6 col-sm-6">
                                      <div class="form-row">
                                        <label class="review-lable">
                                          Chọn sao cho sản phẩm
                                        </label>
                                        <div class="rating">
                                            <input class="star" type="radio" hidden id="star1" name="rating" value="1" />
                                            <label for="star1" title="Poor" id="icon-star1">
                                                <i class="fa fa-star"></i>
                                            </label>
                                            <input class="star" type="radio" hidden id="star2" name="rating" value="2" />
                                            <label for="star2" title="Fair" id="icon-star2">
                                                <i class="fa fa-star"></i>
                                            </label>
                                            <input class="star" type="radio" hidden id="star3" name="rating" value="3" />
                                            <label for="star3" title="Good" id="icon-star3">
                                                <i class="fa fa-star"></i>
                                            </label>
                                            <input class="star" type="radio" hidden id="star4" name="rating" value="4" />
                                            <label for="star4" title="Very Good" id="icon-star4">
                                                <i class="fa fa-star"></i>
                                            </label>
                                            <input class="star" type="radio" hidden id="star5" name="rating" value="5" />
                                            <label for="star5" title="Excellent" id="icon-star5">
                                                <i class="fa fa-star"></i>
                                            </label>
                                        </div>
                                      </div>
                                      <div class="form-row">
                                        <label class="review-lable">
                                          Nội dung đánh giá
                                        </label>
                                        <textarea style="width: 100%;" name="content" rows="7" >
                                        </textarea>
                                      </div>
                                      <div class="form-row">
                                        <input type="submit" value="Đánh Giá" class="button">
                                      </div>
                                    </div>
                                  @endif
                                  <div class="col-md-6 col-sm-6">
                                    <div class="form-row row">
                                      <div class="col-md-5">
                                        <label class="title-avg-star review-lable">Đánh giá trung bình</label>
                                        <div class="avg-star">
                                          @for($i = 1; $i <= floor($avgRating); $i++)
                                            <i class="fa fa-star"></i>
                                          @endfor
                                          @if (! is_int($avgRating))
                                            <i class="fa fa-star-half-alt"></i>
                                          @endif
                                        </div>
                                        <h4 class="number-avg-star">{{ number_format($avgRating, 1) }}</h4>
                                      </div>
                                      <div class="col-md-6">
                                        <label class="title-avg-star review-lable">Đánh giá</label>
                                        @for ($i = 5; $i >= 1; $i--)
                                          <div class="avg-star">
                                            <x-stars :number="$i" />
                                            <span class="parameter-review">({{ $ratingStatistics[$i] }})</span>
                                          </div>
                                        @endfor
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </form>

                        </div>
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
            <h3> Sản phẩm liên quan </h3>
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

                        </div>
                    </div>
                    <div class="product_content">
                        <span class="product_price">{{ format_number_to_money($relatedProduct->price_sell) }} VNĐ</span>
                        <h3 class="product_title"><a href="{{ route('user.products_detail', $relatedProduct->id) }}">{{ $relatedProduct->name }}</a></h3>
                    </div>
                    <div class="product_info">
                        <ul>
                            <li><a href="{{ route('user.products_detail', $relatedProduct->id) }}" data-toggle="modal" data-target="#modal_box" title="">Xem chi tiết</a></li>
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
