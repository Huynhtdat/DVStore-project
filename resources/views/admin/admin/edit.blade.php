@extends('layouts.admin.admin')
@section('content')
<section section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Information of Admin</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <x-form-crud route="{{ route('admin.admins_update', $user->id) }}" cancel="admin.admins_index" :fields="$fields" :rules="$rules" :messages="$messages" textSubmit="Update"/>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
@vite(['resources/admin/js/user-create.js'])
@endsection
