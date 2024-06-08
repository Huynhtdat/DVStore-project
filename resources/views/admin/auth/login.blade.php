@extends('layouts.admin.admin-auth')

@section('content-auth')
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><b>Login System</b></p>
      @if ($errors->get('disable_reason'))
        <span class="error invalid-feedback" style="display: block">
          {{ implode(", ",$errors->get('disable_reason')) }}
        </span>
      @endif
      <form action="{{ route('admin.login') }}" method="post" id="login-form__js">
        @csrf
        <div class="form-group mb-3">
          <x-admin-input id="email" type="text" value="{{ old('email') }}" name="email" placeholder="Email" />
          @if ($errors->get('email'))
            <span id="email-error" class="error invalid-feedback" style="display: block">
              {{ implode(", ",$errors->get('email')) }}
            </span>
          @endif
        </div>
        <div class="form-group mb-3">
          <div class="input-group">
            <x-admin-input id="password" type="password" value="{{ old('password') }}" name="password" placeholder="Password" />
            <div class="input-group-append">
              <span class="input-group-text" id="toggle-password">
                <i class="fas fa-eye"></i>
              </span>
            </div>
          </div>
          @if ($errors->get('password'))
            <span id="password-error" class="error invalid-feedback" style="display: block">
              {{ implode(", ",$errors->get('password')) }}
            </span>
          @endif
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button id="btn-submit" type="submit" class="btn btn-primary btn-block">LOGIN</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
@vite(['resources/common/js/login.js'])

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.querySelector('#toggle-password');
    const passwordField = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
      // Toggle the type attribute using getAttribute() method
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);

      // Toggle the eye icon
      this.querySelector('i').classList.toggle('fa-eye');
      this.querySelector('i').classList.toggle('fa-eye-slash');
    });
  });
</script>
@endsection
