<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="container_fullwidth content-page" style="display: flex; align-items: center; justify-content: center; min-height: 100vh; background-color: #f8f9fa;">
        <div class="container">
            <div class="col-md-12 container-page">
                <div class="checkout-page" style="background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="checkout-steps">
                        <div class="steps active">
                            <h4 class="title-steps text-center" style="margin-bottom: 20px; font-size: 24px; color: #333;">Quên Mật Khẩu</h4>
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
                                                    <label for="email" style="font-weight: bold; margin-bottom: 5px;">Email đăng kí</label>
                                                    <input type="text" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Nhập email đăng kí tài khoản" style="padding: 10px; border-radius: 5px;">
                                                    @error('email')
                                                        <span id="email-error" class="error invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="text-center" style="margin-top: 20px;">
                                                    <button type="submit" class="btn btn-primary" style="background-color: #007bff; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Quên Mật Khẩu</button>
                                                </div>
                                                <div class="content-footer text-center" style="margin-top: 15px;">
                                                    <a href="{{ route('user.login') }}" style="color: #007bff; text-decoration: none;">Quay lại trang đăng nhập</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
