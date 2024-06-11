<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-form {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 0 auto;
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
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-register {
            width: 200px;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 25px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .social-btn i {
            margin-right: 8px;
        }
        .social-login p {
            margin-bottom: 10px;
        }
        .invalid-feedback {
            display: block;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100">
<div class="container my-auto">
    <form action="{{ route('user.register') }}" method="POST" class="register-form">
        @csrf
        <h1 class="text-center mb-4">Đăng Ký Tài Khoản</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label for="name" class="form-label"><strong>Họ Và Tên:</strong></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nhập Họ Và Tên" value="{{ old('name') }}" required>
                    @if ($errors->get('name'))
                        <span id="name-error" class="invalid-feedback">{{ implode(", ",$errors->get('name')) }}</span>
                    @endif
                </div>
                <div class="form-group mb-4">
                    <label for="email" class="form-label"><strong>Email:</strong></label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Nhập Email" value="{{ old('email') }}" required>
                    @if ($errors->get('email'))
                        <span id="email-error" class="invalid-feedback">{{ implode(", ",$errors->get('email')) }}</span>
                    @endif
                </div>
                <div class="form-group mb-4">
                    <label for="phone_number" class="form-label"><strong>Số Điện Thoại:</strong></label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Nhập Số Điện Thoại" value="{{ old('phone_number') }}">
                    @if ($errors->get('phone_number'))
                        <span id="phone_number-error" class="invalid-feedback">{{ implode(", ",$errors->get('phone_number')) }}</span>
                    @endif
                </div>
                <div class="form-group mb-4">
                    <label for="password" class="form-label"><strong>Mật Khẩu:</strong></label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Nhập Mật Khẩu" required>
                    @if ($errors->get('password'))
                        <span id="password-error" class="invalid-feedback">{{ implode(", ",$errors->get('password')) }}</span>
                    @endif
                </div>
                <div class="form-group mb-4">
                    <label for="password_confirmation" class="form-label"><strong>Xác Nhận Mật Khẩu:</strong></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Xác Nhận Mật Khẩu" required>
                    @if ($errors->get('password_confirm'))
                        <span id="password_confirm-error" class="invalid-feedback">{{ implode(", ",$errors->get('password_confirm')) }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label for="province" class="form-label"><strong>Tỉnh, Thành Phố:</strong></label>
                    <select name="province" id="province" class="form-control" required>
                        <!-- Các tùy chọn của tỉnh, thành phố sẽ được thêm bằng JavaScript -->
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="district" class="form-label"><strong>Quận, Huyện:</strong></label>
                    <select name="district" id="district" class="form-control" required>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="ward" class="form-label"><strong>Phường, Xã:</strong></label>
                    <select name="ward" id="ward" class="form-control" required>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="address" class="form-label"><strong>Địa Chỉ Nhà:</strong></label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Nhập Địa Chỉ Nhà" required>
                </div>
                <input type="hidden" name="role_id" value="2">
            </div>
        </div>
       <button type="submit" class="btn btn-primary btn-lg btn-register d-block mx-auto mb-3">Đăng Ký</button>
        <div class="social-login text-center">
            <p class="mb-0">Hoặc đăng ký với</p>
            <div class="d-flex justify-content-center mt-2">
                <a href="{{ route('social.login', 'facebook') }}" class="btn btn-primary social-btn mx-2">
                    <i class="fab fa-facebook-f"></i> Facebook
                </a>
                <a href="{{ route('social.login', 'google') }}" class="btn btn-danger social-btn mx-2">
                    <i class="fab fa-google"></i> Google
                </a>
            </div>
        </div>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
