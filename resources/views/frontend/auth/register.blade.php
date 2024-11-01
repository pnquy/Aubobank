@extends('frontend.layouts.auth')


@section('content')
    @php
        $title = 'Đăng ký';
        $actionRoute = route('frontend.auth.register');
        $submitBtnLabel = 'Đăng ký';
        $redirectLink = route('frontend.auth.loginView');
        $redirectQuestion = 'Bạn đã có tài khoản?';
        $redirectLabel = 'Đăng nhập ngay';
    @endphp

    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="input-group auth-form-input-group">
                <input id="lastName" name="lastName" class="form-control auth-form-input" placeholder="Họ"
                    value="{{ old('lastName') }}" />
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="input-group auth-form-input-group">
                <input id="firstName" name="firstName" class="form-control auth-form-input" placeholder="Tên"
                    value="{{ old('firstName') }}" />
            </div>
        </div>
    </div>

    <div class="input-group auth-form-input-group">
        <input id="phoneNumber" name="phoneNumber" class="form-control auth-form-input" placeholder="Số điện thoại"
            value="{{ old('phoneNumber') }}" />
    </div>

    <div class="input-group auth-form-input-group">
        <input id="email" name="email" class="form-control auth-form-input" placeholder="Email"
            value="{{ old('email') }}" />
    </div>

    <div class="input-group auth-form-input-group">
        <input id="password" name="password" class="form-control auth-form-input" type="password" placeholder="Mật khẩu"
            value="{{ old('password') }}" />
        <i class="fa-solid fa-eye auth-form-input-password-icon" id="togglePassword"></i>
    </div>

    <div class="input-group auth-form-input-group">
        <input id="confirmPassword" name="confirmPassword" class="form-control auth-form-input" type="password"
            placeholder="Mật khẩu" value="{{ old('confirmPassword') }}" />
        <i class="fa-solid fa-eye auth-form-input-password-icon" id="toggleConfirmPassword"></i>
    </div>

    <div class="auth-form-register-footer">
        Bằng cách nhấp vào Đăng ký, bạn đồng ý với <span class="text-primary">Điều khoản và Chinh sách
            quyền riêng tư</span> của chúng tôi
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

                $('#toggleConfirmPassword').click(function() {
                    var passwordField = $('#confirmPassword');

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
