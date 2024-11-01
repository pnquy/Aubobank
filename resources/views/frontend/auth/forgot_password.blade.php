@extends('frontend.layouts.auth')


@section('content')
    @php
        $title = 'Quên mật khẩu';
        $actionRoute = route('frontend.auth.send_forgot_password_email');
        $submitBtnLabel = 'Gửi yêu cầu';
        $backLabel = 'Quay lại';
    @endphp

    <div class="input-group auth-form-input-group">
        <input id="email" name="email" class="form-control auth-form-input" placeholder="Email"
            value="{{ old('email') }}" />
    </div>

    @push('after-scripts')
        <script>
            $(document).ready(function() {

            });
        </script>
    @endpush
@endsection
