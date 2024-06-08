<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .form-group {
            max-width: 400px;
            margin: 0 auto;
        }
        .register-form {
            border: 1px solid #dee2e6;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .social-login {
            margin-top: 20px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="container my-auto">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-12 col-md-8 col-lg-6 mx-auto">
            <form action="{{ route('user.register') }}" method="POST" class="register-form">
                @csrf
                <h1 class="text-center mb-4">Tạo Tài Khoản</h1>
                <div class="form-group mb-3">
                    <label for="name" class="form-label"><strong>Name:</strong></label>
                    <input type="text" name="name" id="name" class="form-control rounded-3" placeholder="Name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label"><strong>Email:</strong></label>
                    <input type="email" name="email" id="email" class="form-control rounded-3" placeholder="Email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phone_number" class="form-label"><strong>Phone Number:</strong></label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control rounded-3" placeholder="Phone Number" value="{{ old('phone_number') }}">
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label"><strong>Password:</strong></label>
                    <input type="password" name="password" id="password" class="form-control rounded-3" placeholder="Password" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label"><strong>Confirm Password:</strong></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-3" placeholder="Confirm Password" required>
                </div>
                <input type="hidden" name="role_id" value="2"> <!-- Ẩn role_id với giá trị mặc định là 2 -->
                <button type="submit" class="btn btn-primary btn-lg d-block mx-auto mb-3">Đăng Ký</button>

                <div class="social-login text-center">
                    <p class="mb-0">Hoặc đăng ký với</p></br>
                    <div class="row justify-content-center g-2">
                        <div class="col-auto">
                            <a href="{{ route('social.login', 'facebook') }}" class="btn btn-primary social-btn">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('social.login', 'google') }}" class="btn btn-danger social-btn">
                                <i class="fab fa-google"></i> Google
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
