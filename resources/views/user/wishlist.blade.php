@extends('layouts.user.main-client')

@section('content-client')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul>
                    <li><a href="{{ route('user.home') }}">home</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>wishlist</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--shopping cart area start -->
<div class="shopping_cart_area">
    <form action="#">
         <div class="row">
             <div class="col-12">
                 <div class="table_desc wishlist">
                     <div class="cart_page table-responsive">
                         <table>
                             <thead>
                                 <tr>
                                     <th class="product_remove">Delete</th>
                                     <th class="product_thumb">Image</th>
                                     <th class="product_name">Product</th>
                                     <th class="product-price">Price</th>
                                     <th class="product_quantity">Stock Status</th>
                                     <th class="product_total">Add To Cart</th>
                                 </tr>
                             </thead>
                             <tbody>
                                @foreach ($products as $product)
                                 <tr>
                                     <td class="product_remove">
                                         <form action="{{ route('wishlist.remove') }}" method="POST">
                                             @csrf
                                             <input type="hidden" name="product_id" value="{{ $product->id }}">
                                             <button type="submit">X</button>
                                         </form>
                                     </td>
                                     <td class="product_thumb">
                                         <a href="{{ route('user.products_detail', $product->id) }}">
                                             <img src="{{ asset('asset/client/images/products/small/' . $product->img) }}" alt="{{ $product->name }}">
                                         </a>
                                     </td>
                                     <td class="product_name">
                                         <a href="{{ route('user.products_detail', $product->id) }}">{{ $product->name }}</a>
                                     </td>
                                     <td class="product-price">{{ format_number_to_money($product->price_sell) }} VND</td>
                                     <td class="product_quantity">{{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</td>
                                     <td class="product_total">
                                         <form action="{{ route('cart.store') }}" method="POST">
                                             @csrf
                                             <input type="hidden" name="id" value="{{ $product->id }}">
                                             <input type="hidden" name="quantity" value="1">
                                             <button type="submit">Add To Cart</button>
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
<!--shopping cart area end -->
@endsection
