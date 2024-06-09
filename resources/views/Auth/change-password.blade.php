
<div class="container_fullwidth content-page">
    <div class="container">
        <div class="col-md-12 container-page">
            <div class="checkout-page">
              <ol class="checkout-steps">
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
                                <input type="hidden" value="{{ $token }}" name="token">
                                @csrf
                                <div class="form-group">
                                  <label for="password">Mật Khẩu Mới</label>
                                  <input type="password" class="form-control" value="{{ old('password') }}" id="password" name="password" placeholder="Nhập mật khẩu mới">
                                  @error('password')
                                    <span id="password-error" class="error invalid-feedback" style="display: block">
                                      {{ $message }}
                                    </span>
                                  @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirm">Xác Nhận Mật Khẩu Mới</label>
                                    <input type="password" class="form-control" value="{{ old('password_confirm') }}" id="password_confirm" name="password_confirm" placeholder="Xác nhận mật khẩu mới">
                                    @error('password_confirm')
                                      <span id="password_confirm-error" class="error invalid-feedback" style="display: block">
                                        {{ $message }}
                                      </span>
                                    @enderror
                                  </div>
                                <div class="text-center">
                                    <button type="submit">Đổi Mật Khẩu</button>
                                </div>
                                <div class="content-footer">
                                    <a href="{{ route('user.login') }}">
                                      Quay lại trang đăng nhập
                                    </a>
                                </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
              </ol>
            </div>
          </div>
    </div>
</div>

