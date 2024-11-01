<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} @yield('title')</title>
    <link rel="icon" href="{{ asset('/img/brand/logo.png') }}" type="image/x-icon">
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Tran Sang')">
    @yield('meta')

    @stack('before-styles')
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    @stack('after-styles')
</head>

<body>
    <div class="container mt-5">
        <div class="alert alert-danger text-center">
            Đã có lỗi xảy ra, vui lòng liên hệ admin
        </div>
    </div>

    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/frontend/app.js') }}"></script>

</body>

</html>
