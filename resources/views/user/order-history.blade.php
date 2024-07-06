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
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>Lịch sử đặt hàng</li>
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
                <th scope="col" class="text-center">ID đơn hàng</th>
                <th scope="col" class="text-center">Tổng số lượng</th>
                <th scope="col" class="text-center">Ngày đặt hàng</th>
                <th scope="col" class="text-center">Phương thức thanh toán</th>
                <th scope="col" class="text-center">Trạng thái đơn hàng</th>
                <th scope="col" class="text-center">Chức năng</th>
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
                            <span class="badge badge-warning">Chờ xử lý</span>
                        @elseif($orderHistory->status == 1)
                            <span class="badge badge-info">Đang giao hàng</span>
                        @elseif($orderHistory->status == 2)
                            <span class="badge badge-danger">Đã hủy</span>
                        @elseif($orderHistory->status == 3)
                            <span class="badge badge-success">Đã nhận hàng</span>
                        @endif
                    </td>

                    <td>
                      <div style="padding: 8px; display: flex; justify-content: start;">
                        <a class="btn-a" href="{{ route('order_history.show', $orderHistory->id) }}">Chi tiết</a>
                        @if ($orderHistory->status == 0)
                          <a class="btn-a" style="margin-left: 20px;" href="{{ route('order_history.update', $orderHistory->id) }}">Hủy Đơn</a>
                        @elseif($orderHistory->status == 1)
                          <a class="btn-a" style="margin-left: 20px;" href="{{ route('order_history.update', $orderHistory->id) }}">Xác Nhận</a>
                        @elseif($orderHistory->status == 2)
                        <a class="btn-a" style="margin-left: 20px;" href="{{ route('order_history.update', $orderHistory->id) }}">Xóa Đơn</a>
                        @elseif($orderHistory->status == 3)
                          <a class="btn-a" style="margin-left: 20px;" href="{{ route('order_history.update', $orderHistory->id) }}">Xóa Đơn</a>
                        @endif
                      </div>
                    </td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="7">
                    Không có dữ liệu
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
