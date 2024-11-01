<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordpress</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/upgrade.scss', 'resources/sass/profile.scss', 'resources/js/upgrade.js'])
</head>

<body style="background-color: #189444;">
    @include('layouts.menu')

    <div class="profile" style="background-color: #f1f5f8;">
        @include('layouts.navigation')
        <div class="upgrade">
            <p class="title">Chọn gói để gia hạn</p>
            <div class="more">
                <p>Vui lòng chọn gói tương ứng với cổng ngân hàng sử dụng. Nạp tiền <</p>
                        <a href="">tại đây</a>
                        <p>> để có sCoin gia hạn</p>
            </div>
            <p>GIẢM 10% KHI GIA HẠN 1 NĂM ĐỐI VỚI MOMO VÀ CÁC NGÂN HÀNG.</p>
            <div class="block-package">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>