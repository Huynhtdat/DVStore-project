<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 25px;
            font-weight: bold;
        }
        .social-btn i {
            margin-right: 8px;
        }
    </style>
</head>
<body class="d-flex align-items-center min-vh-100">
<div class="container_fullwidth content-page">
    <div class="container">
        <div class="col-md-12 container-page">
            <div class="checkout-page">
              <ol class="checkout-steps">
                <li class="steps active">
                  <h4 class="title-steps text-center">
                    Quên Mật Khẩu
                  </h4>
                  <div class="step-description">
                    <div class="row">
                      <div class="col-md-12 col-sm-12">
                        <div class="run-customer">
                          <form action="{{ route('user.forgot_password_create') }}" method="POST" id="login-form__js">
                            @csrf
                            @if (session('notify'))
                              <p style="font-size: 15px;" class="text-success">{{ session('notify') }}</p>
                            @endif
                            <div class="form-group">
                              <label for="email">Email đăng kí</label>
                              <input type="text" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Nhập email đăng kí tài khoản">
                              @error('email')
                                <span id="email-error" class="error invalid-feedback" style="display: block">
                                  {{ $message }}
                                </span>
                              @enderror
                            </div>
                            <div class="text-center">
                                <button type="button">Quên Mật Khẩu</button>
                            </div>
                            <div>
                                <a href="{{ route('user.login') }}">Quay lại trang đăng nhập</a>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
              </ol>
            </div>
          </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
