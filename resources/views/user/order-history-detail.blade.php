@extends('layouts.user.main-client')
@section('content-client')
<style>
  .a-hover:hover{
    color:black !important;
  }
</style>
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul>
                    <li><a href="{{ route('user.home') }}">Trang chủ</a></li>
                    <li><a href="{{ route('order_history.index') }}">Lịch sử đặt hàng</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>Chi tiết đơn hàng {{ $order->id }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<div class="container_fullwidth">
    <div class="container shopping-cart">
      <div class="row">
        <div class="col-md-12">

          <div style="padding-bottom: 30px;">
            <a href="{{ route('order_history.index') }}" class="btn-a">Back</a>
          </div>
          <div class="clearfix">
          </div>
          <table class="table table-bordered table-cart">
            <thead>
              <tr>
                <th scope="col" class="text-center" style="width: 100px;">ID Sản phẩm</th>
                <th scope="col" class="text-center">Tên sản phẩm</th>
                <th scope="col" class="text-center">Hình ảnh</th>
                <th scope="col" class="text-center">Màu sắc</th>
                <th scope="col" class="text-center">Kích thước</th>
                <th scope="col" class="text-center">Số lượng</th>
                <th scope="col" class="text-center">Giá</th>
                <th scope="col" class="text-center">Tổng tiền</th>
              </tr>
            </thead>
            <tbody>
              <?php $totalProductMoney = 0;?>
              @foreach ($order_details as $order_detail)
                <?php $totalProductMoney +=  $order_detail->unit_price *  $order_detail->quantity;?>
                <tr>
                    <td>{{ $order_detail->product_id }}</td>
                    <td>
                      <a href="{{ route('user.products_detail', $order_detail->product_id) }}">{{ $order_detail->product_name }}</a>
                    </td>
                    <td class="text-center">
                      <img style="width: 70px; height:auto; object-fit: cover;" src="{{ asset("asset/client/images/products/small/$order_detail->product_img") }}" alt="">
                    </td>
                    <td>{{ $order_detail->color_name }}</td>
                    <td>{{ $order_detail->size_name }}</td>
                    <td>{{ $order_detail->quantity }}</td>
                    <td>{{ format_number_to_money($order_detail->unit_price) }}</td>
                    <td>{{ format_number_to_money($order_detail->unit_price *  $order_detail->quantity) }}</td>
                </tr>
              @endforeach
              <tr>
                <td colspan="7">Tổng số lượng sản phẩm</td>
                <td style="font-weight: 600;">{{ format_number_to_money($totalProductMoney) }} VND</td>
              </tr>
              {{-- <tr>
                <td colspan="7">Shipping Fee</td>
                <td style="font-weight: 600;">{{ format_number_to_money($infomationUser->orders_transport_fee) }} VND</td>
              </tr> --}}
              <tr>
                <td colspan="7">Phương thức thanh toán</td>
                <td>
                    <span class="badge badge-info">{{ $infomationUser->payment_name }}</span>
                </td>
              </tr>
              <tr>
                <td colspan="7">Tổng tiền đơn hàng</td>
                <td style="font-weight: 600;"   >
                    {{ format_number_to_money($order->total_money) }} VND
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="clearfix">
      </div>
    </div>
</div>
@vite(['resources/client/css/cart.css'])
@endsection
