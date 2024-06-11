<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Thực Tài Khoản</title>
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
        }
        .title-steps {
            font-weight: bold;
            margin-bottom: 20px;
        }
        .text-notification {
            margin-bottom: 20px;
            font-size: 16px;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .text-success {
            font-weight: bold;
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
                            <h4 class="title-steps text-center">Xác Thực Tài Khoản</h4>
                            <div class="step-description">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="run-customer">
                                            <form action="{{ route('user.resend_email') }}" method="POST" id="login-form__js">
                                                <input type="hidden" value="{{ $user->id }}" name="id">
                                                <p class="text-center text-notification">
                                                    Chúng tôi đã gửi một liên kết xác nhận đến địa chỉ email {{ $user->email }} của bạn. Vui lòng xác thực tài khoản để tiếp tục sử dụng dịch vụ. Nếu bạn không nhận được liên kết, vui lòng nhấn nút bên dưới để được gửi lại.
                                                </p>
                                                @if (session('status') == 'verification-link-sent')
                                                    <p class="text-success text-notification text-center">
                                                        Một liên kết xác nhận mới đã được gửi đến địa chỉ email của bạn.
                                                    </p>
                                                @endif
                                                @csrf
                                                <div class="text-center">
                                                    <button class="btn btn-success">Gửi lại liên kết</button>
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
