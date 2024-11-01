<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordpress</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/profile.scss','resources/sass/purchase.scss'])
</head>

<body style="background-color: #189444;">
    @include('layouts.menu')

    <div class="profile" style="background-color: #f1f5f8;">
        @include('layouts.navigation')
        <div class="main">
            <p class="title">Chuyển khoản qua ngân hàng</p>
            <div class="more">
                <p>Thực hiện chuyển khoản ngân hàng vào số tài khoản bên dưới. Vui lòng nhập đúng nội dung chuyển khoản và chờ ở trang này cho đến khi hệ thống báo thành công.</p>
            </div>
            <div class="block-package">
                @yield('content')
            </div>
            <h2 class="intro-y text-2xl font-medium mt-10 text-center mr-auto">
    Lịch sử nạp tiền hôm nay
</h2>

<div class="col-12 col-sm-offset-2 col-sm-10 col-md-12 col-lg-offset-2 col-lg-10 mx-auto">
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table id="example" class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">THỜI GIAN</th>
                    <th class="text-center whitespace-nowrap">NỘI DUNG</th>
                    <th class="text-center whitespace-nowrap">MÃ GIAO DỊCH</th>
                    <th class="text-center whitespace-nowrap">SỐ TIỀN</th>
                    <th class="text-center whitespace-nowrap">SPOINT</th>
                    <th class="text-center whitespace-nowrap">TRẠNG THÁI</th>
                </tr>
            </thead>
            <tbody id="historytable">
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_time }}</td>
                    <td class="text-center">{{ $transaction->content }}</td>
                    <td class="text-center">{{ $transaction->transaction_code }}</td>
                    <td class="text-center">{{ $transaction->amount }}</td>
                    <td class="text-center">{{ $transaction->spoint }}</td>
                    <td class="text-center">{{ $transaction->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

            </div>
        </div>
    </div>
</body>

</html>