<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài liệu API</title>
</head>
@vite(['resources/js/form.js','resources/sass/overview.scss','resources/sass/apidata.scss','resources/js/app.js'])

<body style="background-color: #189444;">
    @include('layouts.menu')

    {{-- <div class="profile">
        @include('layouts.navigation')
        @include('overview.alert')
        <div class="tongquan">
            <section class="third">
                <ul class="third-left">
                    <li class="third-items left">Thống kê tài khoản</li>
                </ul>

                <ul class="third-right">
                    <li class="third-items">
                        <i class="fa fa-refresh" aria-hidden="true" style="margin-left: 10px"></i>
                    </li>
                    <li class="third-items">Tải lại trang</li>
                </ul>
            </section>

            @include('overview.overview')

            <section class="fifth">
                <div class="option">Chọn 1 cổng thanh toán liên kết</div>
            </section>
            @include('overview.choose')
            @include('overview.notice')
        </div>
    </div> --}}
    <div class="profile">
        @include('layouts.navigation')
        @include('document.api-items')

        
    </div>

</body>

</html>
