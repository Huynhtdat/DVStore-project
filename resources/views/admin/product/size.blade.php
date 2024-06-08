@extends('layouts.admin.admin')
@section('content')
<section class="content">
  <div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb float-sm-left">
						<li class="breadcrumb-item">
                            <a href="{{ $routeProduct }}">Product</a>
                        </li>
						<li class="breadcrumb-item">
                            <a href="{{ $routeColor }}">Product Color</a>
                        </li>
						<li class="breadcrumb-item active">
							Product Size
						</li>
                        <li class="breadcrumb-item">
                            <a href="{{ $routeImage }}">Product Image detail</a>
                        </li>
				</ol>
			</div>
			<div class="col-12">
				<div class="card">
					<div class="card-header text-right">
						<button class="btn btn-success" data-toggle="modal" data-target="#modal-default">
							<i class="fas fa-plus"></i> Add Size
						</button>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap">
							<thead>
								<tr>
									<th>ID</th>
									<th>Size Name</th>
									<th>Color</th>
									<th>Quantity</th>
									<th>Tools</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($productSizes as $productSize)
									<tr>
										<td>{{ $productSize->id }}</td>
										<td>{{ $productSize->size_name }}</td>
										<td>{{ $productSize->color_name }}</td>
										<td>{{ $productSize->quanity }}</td>
										<td>
											<button class="btn btn-primary edit"
												url-update="{{ route('admin.update_size_product', [$productSize->id, $product->id]) }}"
												url-get-size="{{ route('admin.size_by_product_color_edit', $productSize->id) }}"
												>
												<i class="fas fa-edit"></i>
											</button>
											<button class="btn btn-danger delete" url-delete="{{ route('admin.delete_size_product', $productSize->id) }}">
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
				<h4 class="modal-title">Add New Size</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post"
					class="form-submit"
					url-store="{{ route('admin.store_size_product', $product->id) }}" method="POST"
					enctype="multipart/form-data">
				<div class="modal-body">
					<x-admin-input-prepend label="Color" width="auto">
						<select class="form-control" name="product_color_id" id="color_id">
							@foreach ($productColors as $productColor)
									<option value="{{ $productColor->id }}">{{ $productColor->color->name }}</option>
							@endforeach
						</select>
					</x-admin-input-prepend>
					<x-admin-input-prepend label="Size" width="auto">
						<select url-get-size="{{ route('admin.size_by_product_color') }}" class="form-control" name="size_id" id="size_id">

						</select>
					</x-admin-input-prepend>
					<x-admin-input-prepend label="Quantity" width="auto">
						<input id="quantity" type="number" min="0" name="quantity"class="form-control">
					</x-admin-input-prepend>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">CACEL</button>
					<button type="submit" class="btn btn-primary">ADD</button>
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
				<h4 class="modal-title">Edit Product Size</h4>
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
['resources/admin/js/product-size.js'])
@endsection
