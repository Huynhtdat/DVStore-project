@extends('layouts.admin.admin')
@section('content')
<section class="content">
  <div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb float-sm-left">
						<li class="breadcrumb-item">
                            <a href="{{ $routeProduct }}">Sản phẩm</a>
                        </li>
						<li class="breadcrumb-item">
                            <a href="{{ $routeColor }}">Màu sản phẩm</a>
                        </li>
						<li class="breadcrumb-item">
							<a href="{{ $routeSize }}">Kích thước sản phẩm</a>
						</li>
                        <li class="breadcrumb-item active">
                            Hình ảnh chi tiết sản phẩm
                        </li>
				</ol>
			</div>
			<div class="col-12">
				<div class="card">
					<div class="card-header text-right">
						<button class="btn btn-success" data-toggle="modal" data-target="#modal-default">
							<i class="fas fa-plus"></i> Thêm hình ảnh
						</button>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap">
							<thead>
								<tr>
									<th>ID</th>
									<th>Hình ảnh</th>
									<th>Chức năng</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($productImages as $productImage)
									<tr>
										<td>{{ $productImage->id }}</td>
										<td>
											<img style="width:100px;" src="{{ asset("asset/client/images/products/small/$productImage->img") }}" alt="">
										</td>
										<td>
											<button class="btn btn-primary edit"
												url-update="{{ route('admin.products_image_update', $productImage->id) }}"
												url-img="{{ asset('asset/client/images/products/small/') }}"
												>
												<i class="fas fa-edit"></i>
											</button>
											<button class="btn btn-danger delete" url-delete="{{ route('admin.products_image_delete', $productImage->id) }}">
												<i class="fas fa-trash"></i>
											</button>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>
	</div>
  <!-- /.container-fluid -->
</section>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Thêm hình ảnh mới</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post"
					class="form-submit"
					url-store="{{ route('admin.products_image_store', $product->id) }}" method="POST"
					enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<div class="preview">
							<img id="img-preview" style="width: 60px" src="" />
							<label for="file-input" id="lable-img">Hình ảnh</label>
							<input class="img-product" hidden accept="image/*" type="file" id="file-input" name="img"/>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
					<button type="submit" class="btn btn-primary">Thêm</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Chỉnh sửa hình ảnh chi tiết</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="body-modal-edit">

			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
@vite(
[
  'resources/admin/js/product-image.js',
  'resources/admin/css/product.css',
])
@endsection
