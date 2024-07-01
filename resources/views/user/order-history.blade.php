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
                    <li><a href="{{ route('user.home') }}">home</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>Order History</li>
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

          <div class="clearfix">
          </div>
          <table class="table table-bordered table-cart">
            <thead>
              <tr>
                <th scope="col" class="text-center">Order ID</th>
                <th scope="col" class="text-center">Total Amount</th>
                <th scope="col" class="text-center">Order Date</th>
                <th scope="col" class="text-center">Payment Method</th>
                <th scope="col" class="text-center">Order Status</th>
                <th scope="col" class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @if (count($orderHistorys) > 0)
                @foreach ($orderHistorys as $orderHistory)
                  <tr>
                    <td>{{ $orderHistory->id }}</td>
                    <td>{{ format_number_to_money($orderHistory->total_money) }}</td>
                    <td>{{ $orderHistory->created_at }}</td>
                    <td><span class="badge badge-info">{{ $orderHistory->payment_name }}</span></td>
                    <td>
                      @if ($orderHistory->status == 0)
                          <span class="badge badge-warning">Pending</span>
                      @elseif($orderHistory->status == 1)
                          <span class="badge badge-info">In Transit</span>
                      @elseif($orderHistory->status == 2)
                          <span class="badge badge-danger">Cancelled</span>
                      @elseif($orderHistory->status == 3)
                          <span class="badge badge-success">Delivered</span>
                      @endif
                    </td>

                    <td>
                      <div style="padding: 8px; display: flex; justify-content: start;">
                        <a class="btn-a" href="{{ route('order_history.show', $orderHistory->id) }}">Details</a>
                        @if ($orderHistory->status == 0)
                          <a class="btn-a" style="margin-left: 20px;" href="{{ route('order_history.update', $orderHistory->id) }}">Cancel Order</a>
                        @elseif($orderHistory->status == 1)
                          <a class="btn-a" style="margin-left: 20px;" href="{{ route('order_history.update', $orderHistory->id) }}">Confirm</a>
                        @elseif($orderHistory->status == 2)
                          <a class="btn-a" style="margin-left: 20px;" href="{{ route('order_history.update', $orderHistory->id) }}">Delete Order</a>
                        @elseif($orderHistory->status == 3)
                          <a class="btn-a" style="margin-left: 20px;" href="{{ route('order_history.update', $orderHistory->id) }}">Delete Order</a>
                        @endif
                      </div>
                    </td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="7">
                    No data available
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
        @if (count($orderHistorys) > 0)
        <div class="text-center">
            <ul class="pagination">
                {{ $orderHistorys->links('vendor.pagination-default') }}
            </ul>
        </div>
        @endif
      </div>
      <div class="clearfix">
      </div>
    </div>
</div>
@vite(['resources/client/css/cart.css'])
@endsection
