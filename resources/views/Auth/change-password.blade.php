<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu Mới</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .content-page {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container-page {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        .title-steps {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            padding: 10px;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .content-footer a {
            color: #007bff;
            text-decoration: none;
        }
        .content-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container_fullwidth content-page">
        <div class="container">
            <div class="col-md-12 container-page">
                <div class="checkout-page">
                    <ol class="checkout-steps list-unstyled">
                        <li class="steps active">
                            <h4 class="title-steps text-center">
                                Đổi Mật Khẩu Mới
                            </h4>
                            <div class="step-description">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="run-customer">
                                            <div id="form-data" hidden data-rules="{{ json_encode($rules) }}" data-messages="{{ json_encode($messages) }}"></div>
                                            <form action="{{ route('user.change_new_password') }}" method="POST" id="form__js">
                                                @csrf
                                                <input type="hidden" value="{{ $token }}" name="token">
                                                <div class="form-group">
                                                    <label for="password" class="form-label">Mật Khẩu Mới</label>
                                                    <input type="password" class="form-control" value="{{ old('password') }}" id="password" name="password" placeholder="Nhập mật khẩu mới">
                                                    @error('password')
                                                        <span id="password-error" class="error invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="password_confirm" class="form-label">Xác Nhận Mật Khẩu Mới</label>
                                                    <input type="password" class="form-control" value="{{ old('password_confirm') }}" id="password_confirm" name="password_confirm" placeholder="Xác nhận mật khẩu mới">
                                                    @error('password_confirm')
                                                        <span id="password_confirm-error" class="error invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Đổi Mật Khẩu</button>
                                                </div>
                                                <div class="content-footer text-center mt-3">
                                                    <a href="{{ route('user.login') }}">
                                                        Quay lại trang đăng nhập
                                                    </a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
