@extends('layouts.user.main-client')

@section('content-client')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách yêu thích</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--shopping cart area start -->
<div class="shopping_cart_area py-5">
    <div class="container">
        <form action="#">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc wishlist">
                        <div class="cart_page table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th>Xóa</th>
                                        <th>Hình ảnh</th>
                                        <th>Sản phẩm</th>
                                        <th>Giá tiền</th>
                                        <th>Tồn kho</th>
                                        <th>Thêm vào giỏ hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr class="text-center align-middle">
                                        <td class="product_remove align-middle">
                                            <form action="{{ route('wishlist.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </td>
                                        <td class="product_thumb align-middle">
                                            <a href="{{ route('user.products_detail', $product->id) }}">
                                                <img src="{{ asset('asset/client/images/products/small/' . $product->img) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 100px;">
                                            </a>
                                        </td>
                                        <td class="product_name align-middle">
                                            <a href="{{ route('user.products_detail', $product->id) }}">{{ $product->name }}</a>
                                        </td>
                                        <td class="product-price align-middle">{{ format_number_to_money($product->price_sell) }} VND</td>
                                        <td class="product_quantity align-middle">{{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</td>
                                        <td class="product_total align-middle">
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--shopping cart area end -->
@endsection
