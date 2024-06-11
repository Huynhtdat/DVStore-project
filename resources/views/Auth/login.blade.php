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
        body {
            background-color: #f8f9fa;
        }
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 25px;
            font-weight: bold;
            color: #fff;
        }
        .social-btn i {
            margin-right: 8px;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-header {
            margin-bottom: 20px;
        }
        .login-header h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
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
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="d-flex align-items-center min-vh-100">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="login-container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.login') }}" method="POST">
                    @csrf
                    <div class="login-header">
                        <h1>Đăng Nhập</h1>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><strong>Email:</strong></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Nhập Email" required>
                        @if ($errors->get('email'))
                            <span id="email-error" class="error invalid-feedback" style="display: block">
                                {{ implode(", ", $errors->get('email')) }}
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><strong>Mật Khẩu:</strong></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Nhập Mật Khẩu" required>
                        @if ($errors->get('password'))
                            <span id="password-error" class="error invalid-feedback" style="display: block">
                                {{ implode(", ", $errors->get('password')) }}
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary d-block w-100">Đăng Nhập</button>
                </form>
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
                <div class="text-center mt-3">
                    <a href="{{ route('user.forgot_password_create') }}">Quên mật khẩu</a>
                </div>
                <p class="mt-3 text-center">Nếu bạn chưa có tài khoản, <a href="{{ route('user.register') }}">Đăng ký</a> ngay.</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
