@extends('layouts.admin.admin')
@section('content')
<section section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Information of Order</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="col-md-12 mt-3">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Information of Customer</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Fullname</th>
                      <th>Phone Nuber</th>
                      <th>Email</th>
                      <th>Address</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ $infomation_user['id'] }}</td>
                      <td>{{ $infomation_user['name'] }}</td>
                      <td>{{ $infomation_user['phone_number'] }}</td>
                      <td>{{ $infomation_user['email'] }}</td>
                      <td>{{ $infomation_user['apartment_number'] . ', ' . $infomation_user['ward'] . ', ' . $infomation_user['district'] . ', ' . $infomation_user['city'] }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-12 mt-3">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Detail</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 100px;">ID Product</th>
                      <th>Name Product</th>
                      <th>Image</th>
                      <th>Color</th>
                      <th>Size</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Into Money</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $totalProductMoney = 0;?>
                    @foreach ($order_details as $order_detail)
                      <?php $totalProductMoney +=  $order_detail->unit_price *  $order_detail->quantity;?>
                      <tr>
                        <td>{{ $order_detail->product_id }}</td>
                        <td>{{ $order_detail->product_name }}</td>
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
                      <td colspan="7">Total Money Product</td>
                      <td><b>{{ format_number_to_money($totalProductMoney) }} VND</b></td>
                    </tr>
                    <tr>
                      <td colspan="7">Transport Fee</td>
                      <td><b>{{ format_number_to_money($infomation_user['orders_transport_fee']) }} VND</b></td>
                    </tr>
                    <tr>
                      <td colspan="7">Payment Method</td>
                      <td><b>{{ $infomation_user['payment_name'] }}</b></td>
                    </tr>
                    <tr>
                      <td colspan="7">Total Money Order</td>
                      <td><b>{{ format_number_to_money($order->total_money) }} VND</b></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          @if ($order->order_status != 3)
          <div class="action col-md-12 pb-3">
            <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg">Order processing</button>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <x-modal-view-detail size="modal-lg" title="Order processing">
    <form action="{{ route('admin.orders_update', $order->id) }}" method="post">
      @csrf
      <div class="form-group">
        <select class="form-control" name="status" id="status">
          <option value="1">Confirm</option>
          <option value="2">Cancel</option>
        </select>
      </div>
      <div class="form-group text-center">
        <button class="btn btn-primary">
          Handle
        </button>
      </div>
    </form>
  </x-modal-view-detail>
  <!-- /.container-fluid -->
</section>
@endsection
