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
</head>
<body class="d-flex align-items-center min-vh-100">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="border p-4 rounded shadow-sm">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <h1 class="mb-4 text-center">Đăng Nhập</h1>
                    <div class="mb-3">
                        <label for="email" class="form-label"><strong>Email:</strong></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><strong>Password:</strong></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary d-block mx-auto">Đăng Nhập</button>
                </form>

                <!-- Thêm thông báo và liên kết đăng ký -->
                <p class="mt-3">Nếu bạn chưa có tài khoản, <a href="{{ route('register') }}">Đăng ký</a> ngay.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
