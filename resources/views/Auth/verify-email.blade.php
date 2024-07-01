@extends('layouts.user.main-client')

@section('content-client')
<style>
.title-steps {
  padding: 15px 25px;
  font-weight: bold;
  font-size: 20px;
}

.text-notification {
  font-size: 16px;
}
</style>

<div class="container-fluid content-page">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <h4 class="title-steps text-center">Xác Thực Tài Khoản</h4>

            <div class="step-description">
              <p class="text-center text-notification">
                Chúng tôi đã gởi một liên kết xác nhận đến địa chỉ email {{ $user->email }} của bạn. Vui lòng xác thực tài khoản để tiếp tục sử dụng dịch vụ. Nếu bạn không nhận được liên kết, vui lòng bấm nút bên dưới để gửi lại.
              </p>

              @if (session('status') == 'verification-link-sent')
                <p class="text-success text-notification text-center">
                  Một liên kết xác nhận mới đã được gửi đến địa chỉ email của bạn.
                </p>
              @endif

              <form action="{{ route('user.resend_email') }}" method="POST" id="resend-email-form">
                @csrf
                <input type="hidden" value="{{ $user->id }}" name="id">
                <div class="text-center">
                  <button type="submit" class="btn btn-success">
                    Gửi lại liên kết
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
