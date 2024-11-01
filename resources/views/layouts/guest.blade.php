<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/guest.scss','resources/css/style.css'])
</head>

<body class="login">
    <div class="container main">
        <div class="left w3-animate-left">
            <div class="head">
                <a href="/">
                    <x-application-logo class="logo" />
                </a>
                <p>sPayment System</p>
            </div>
            <div class="body">
                <img src="{{ asset('img/brand/illustration.svg') }}" alt="Image">
                <h1>Giải pháp</br> Thanh toán tự động</h1>
                <p>Tích hợp thanh toán tự động</p>
            </div>
        </div>
        <div class="right w3-animate-right">
            <h1 id="form-title">Welcome to sPAYMENT SYSTEM</h1>
            <div class="">
                {{ $slot }}
            </div>
        </div>
        <div id="termsPopup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="closeTermsPopup()">&times;</span>
                <h2>Các điều khoản và điều kiện</h2>
                <p>Đây là nội dung của các điều khoản và điều kiện...</p>
            </div>
        </div>
    </div>
</body>


</html>