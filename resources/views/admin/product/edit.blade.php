@extends('layouts.admin.admin')
@section('content')
<section section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
				<ol class="breadcrumb float-sm-left">
						<li class="breadcrumb-item">Sản phẩm</li>
						<li class="breadcrumb-item active">
							<a href="{{ $routeColor }}">Màu sản phẩm</a>
                        </li>
						<li class="breadcrumb-item">
							<a href="{{ $routeSize }}">Kích thước sản phẩm</a>
						</li>
                        <li class="breadcrumb-item">
							<a href="{{ $routeImage }}">Hình ảnh chi tiết sản phẩm</a>
						</li>
				</ol>
			</div>
      <div id="form-data" hidden data-rules="{{ json_encode($rules) }}"
      data-messages="{{ json_encode($messages) }}"></div>
      <form class="row" action="{{route('admin.products_update', $product->id)}}" method="POST" id="form__js" enctype="multipart/form-data">
        @csrf
        <div class="col-xl-12 col-lg-12 col-md-12">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Thông tin sản phẩm</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="row">
              <div class="col-8">
                <div class="card-body row">
                  <x-admin-input-prepend label="Product Name" width="auto">
                    <input
                      id="name"
                      type="text"
                      name="name"
                      value="{{ $product->name }}"
                      class="form-control">
                  </x-admin-input-prepend>

                  <x-admin-input-prepend label="Price Sell" col="col-6" width="auto">
                    <input
                      id="price_sell"
                      type="number"
                      name="price_sell"
                      value="{{ $product->price_sell }}"
                      class="form-control">
                  </x-admin-input-prepend>
                  <x-admin-input-prepend label="Brand" width="auto" col="col-6">
                    <select class="form-control" name="brand_id" id="brand">
                      @foreach ($brands as $brand)
                          <option value="{{ $brand->id }}"
                            @if ($brand->id == $product->brand_id)
                                @selected(true)
                            @endif
                          >{{ $brand->name }}</option>
                      @endforeach
                    </select>
                  </x-admin-input-prepend>
                  <x-admin-input-prepend label="Fashion" width="auto" col="col-6">
                    <select class="form-control" name="parent_id" id="parent_id">
                      @foreach ($categoriesParent as $categoryParent)
                          <option value="{{ $categoryParent->id }}"
                            @if ($categoryParent->id == $product->category->parent_id)
                              @selected(true)
                            @endif
                          >{{ $categoryParent->name }}</option>
                      @endforeach
                    </select>
                  </x-admin-input-prepend>
                  <x-admin-input-prepend label="Category" width="auto" col="col-6">
                    <select class="form-control" value="{{ $product->category_id }}" name="category_id" id="category_id" route="{{ route('admin.category_by_parent') }}">

                    </select>
                  </x-admin-input-prepend>
                  <div class="card card-outline card-info col-12">
                    <div class="card-header">
                      <h3 class="card-title">
                        Mô tả sản phẩm
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <textarea id="summernote" name="description">
                        {{ $product->description }}
                      </textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card-body">
                  <div class="container">
                    <div class="preview">
                      <img id="img-preview" src="{{ asset("asset/client/images/products/small/$product->img") }}" />
                      <label for="file-input">Hình ảnh</label>
                      <input hidden accept="image/*" type="file" id="file-input" name="img"/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 text-center" style="padding-bottom: 10px;">
                <button class="btn btn-success">Cập nhật</button>
                <button class="btn btn-danger">Hủy</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
<script>
</script>
@vite(
[
  'resources/admin/js/user-create.js',
  'resources/admin/js/edit-product.js',
  'resources/admin/css/product.css',
  'resources/admin/css/form-edit.css',
  'resources/common/js/form.js',
])
@endsection
