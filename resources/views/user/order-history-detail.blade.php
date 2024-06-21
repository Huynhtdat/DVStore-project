@extends('layouts.user.main-client')
@section('content-client')
<style>
  .a-hover:hover{
    color:black !important;
  }
</style>
<div class="container_fullwidth">
    <div class="container shopping-cart">
      <div class="row">
        <div class="col-md-12">
          <h3 class="title">
            Order Details {{ $order->id }}
          </h3>
          <div style="padding-bottom: 30px;">
            <a href="{{ route('order_history.index') }}" class="btn-a">Back</a>
          </div>
          <div class="clearfix">
          </div>
          <table class="table table-bordered table-cart">
            <thead>
              <tr>
                <th scope="col" class="text-center" style="width: 100px;">Product ID</th>
                <th scope="col" class="text-center">Product Name</th>
                <th scope="col" class="text-center">Image</th>
                <th scope="col" class="text-center">Color</th>
                <th scope="col" class="text-center">Size</th>
                <th scope="col" class="text-center">Quantity</th>
                <th scope="col" class="text-center">Unit Price</th>
                <th scope="col" class="text-center">Total</th>
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
                <td colspan="7">Total Product Amount</td>
                <td style="font-weight: 600;">{{ format_number_to_money($totalProductMoney) }} VND</td>
              </tr>
              <tr>
                <td colspan="7">Shipping Fee</td>
                <td style="font-weight: 600;">{{ format_number_to_money($infomationUser->orders_transport_fee) }} VND</td>
              </tr>
              <tr>
                <td colspan="7">Payment Method</td>
                <td>
                    <span class="badge badge-info">{{ $infomationUser->payment_name }}</span>
                </td>
              </tr>
              <tr>
                <td colspan="7">Total Order Amount</td>
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
