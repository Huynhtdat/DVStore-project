<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .content-page {
            background-color: #f8f9fa;
            padding: 40px 0;
        }
        .checkout-page {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
        }
        .title-steps {
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 24px;
        }
        .text-notification {
            margin-bottom: 20px;
            font-size: 16px;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
            margin-top: 20px;
        }
        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container_fullwidth content-page">
        <div class="container">
            <div class="col-md-12 container-page">
                <div class="checkout-page mx-auto" style="max-width: 600px;">
                    <ol class="checkout-steps list-unstyled">
                        <li class="steps active">
                            <h4 class="title-steps text-center">
                                @if (session('status') == 'verifify-success')
                                    Xác Thực Tài Khoản Thành Công
                                @elseif(session('status') == 'forgot-password-success')
                                    Thay Đổi Mật Khẩu Thành Công
                                @endif
                            </h4>
                            <div class="step-description">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="run-customer">
                                            @if (session('status') == 'verifify-success')
                                                <p class="text-center text-notification">Chúc mừng bạn tài khoản của bạn đã được xác thực thành công</p>
                                            @elseif(session('status') == 'forgot-password-success')
                                                <p class="text-center text-notification">Chúc mừng bạn đã thay đổi mật khẩu thành công</p>
                                            @endif
                                        </div>
                                        <div class="text-center">
                                            <a href="{{ route('user.login') }}" class="btn btn-success">
                                                Đăng Nhập Ngay
                                            </a>
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
