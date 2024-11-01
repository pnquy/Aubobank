@extends('frontend.layouts.auth')


@section('content')
    @php
        $title = 'Cấp lại mật khẩu';
        $actionRoute = route('frontend.auth.reset_password');
        $submitBtnLabel = 'Cấp lại mật khẩu';
        $backLabel = 'Quay lại';
    @endphp

    <div class="input-group auth-form-input-group">
        <input id="token" name="token" class="form-control auth-form-input" placeholder="Token" readonly
            value="{{ $token ?? old('token') }}" />
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
