@extends('frontend.layouts.auth')


@section('content')
    @php
        $title = 'Đăng nhập';
        $actionRoute = route('frontend.auth.login');
        $submitBtnLabel = 'Đăng nhập';
        $redirectLink = route('frontend.auth.registerView');
        $redirectQuestion = 'Chưa có tài khoản?';
        $redirectLabel = 'Đăng ký ngay';
    @endphp

    <div class="input-group auth-form-input-group">
        <input id="phoneNumber" name="phoneNumber" class="form-control auth-form-input" placeholder="Số điện thoại"
            value="{{ old('phoneNumber') }}" />
    </div>

    <div class="input-group auth-form-input-group">
        <input id="password" name="password" class="form-control auth-form-input" type="password" placeholder="Mật khẩu"
            value="{{ old('password') }}" />
        <i class="fa-solid fa-eye auth-form-input-password-icon" id="togglePassword"></i>

    </div>

    <div class="auth-form-login-footer">
        <div class="form-check auth-form-login-remember">
            <input class="form-check-input auth-form-login-remember-check-box" type="checkbox" id="remember"
                name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label auth-form-login-remember-label" for="remember">
                Nhớ tài khoản
            </label>
        </div>
        <a class="auth-form-forget-password" href="{{ route('frontend.auth.forgot_password_view') }}">
            <i class="fa-solid fa-lock auth-form-forget-password-icon"></i>
            <span class="auth-form-forget-password-label">
                Quên mật khẩu
            </span>
        </a>
    </div>

    @push('after-scripts')
        <script>
            $(document).ready(function() {
                // Sự kiện khi người dùng nhấp vào biểu tượng ẩn/hiện password
                $('#togglePassword').click(function() {
                    var passwordField = $('#password');

                    if (passwordField.attr('type') === 'password') {
                        // Nếu đang ở chế độ password, chuyển sang chế độ text
                        passwordField.attr('type', 'text');
                        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
                    } else {
                        // Nếu đang ở chế độ text, chuyển sang chế độ password
                        passwordField.attr('type', 'password');
                        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
                    }
                });
            });
        </script>
    @endpush
@endsection
