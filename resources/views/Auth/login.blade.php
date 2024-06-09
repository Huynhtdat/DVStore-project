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
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="border p-4 rounded shadow-sm" style="max-width: 400px; width: 100%;">
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
                    <h1 class="mb-4 text-center">Đăng Nhập</h1>
                    <div class="mb-3">
                        <label for="email" class="form-label"><strong>Email:</strong></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Nhập Email" required>
                        @if ($errors->get('email'))
                                <span id="email-error" class="error invalid-feedback" style="display: block">
                                  {{ implode(", ",$errors->get('email')) }}
                                </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><strong>Mật Khẩu:</strong></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Nhập Mật Khẩu" required>
                        @if ($errors->get('password'))
                                <span id="password-error" class="error invalid-feedback" style="display: block">
                                  {{ implode(", ",$errors->get('password')) }}
                                </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary d-block mx-auto">Đăng Nhập</button>
                </form>
                <div class="text-center mt-3">
                    <p>Hoặc đăng nhập với</p>
                    <div class="row g-2 justify-content-center">
                        <div class="col">
                            <a href="{{ route('social.login', 'facebook') }}" class="btn btn-primary social-btn w-100 mb-2">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('social.login', 'google') }}" class="btn btn-danger social-btn w-100">
                                <i class="fab fa-google"></i> Google
                            </a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('user.forgot_password_create') }}">Quên mật khẩu</a>
                <p class="mt-3 text-center">Nếu bạn chưa có tài khoản, <a href="{{ route('user.register') }}">Đăng ký</a> ngay.</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
