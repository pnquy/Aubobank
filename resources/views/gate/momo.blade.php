<!-- resources/views/page1.blade.php -->
@extends('gate.index')

@section('title', 'Danh sách tài khoản MoMo')

@section('content')
<div id="trangthai"></div>
<div class="alert alert-success show mb-2" role="alert" style="margin-bottom: 5px;">
    <div class="mt-3" style="margin-top: 0px;">Nếu API không hoạt động? Vui lòng kiểm tra bằng công cụ API. Hướng dẫn sử dụng: <a href="https://web2m.com/huong-dan-su-dung-cong-cu-kiem-thu-api-vi-dien-tu-tai-he-thong-api-web2m/" target="_blank">https://web2m.com/huong-dan-su-dung-cong-cu-kiem-thu-api-vi-dien-tu-tai-he-thong-api-web2m/</a>
    </div>
</div>
<div class="alert alert-success show mb-2" role="alert" style="margin-bottom: 5px;">
    <div class="mt-3" style="margin-top: 0px;">Để bật tính năng bảo mật chống trộm tiền trên MoMo, vui lòng dùng số điện thoại đăng ký (Số điện thoại đăng nhập) soạn tin SMS nội dung: BATBAOMAT và gửi đến 0982933507
    </div>
</div>
<div class="alert alert-success show mb-2" role="alert" style="margin-bottom: 5px;">
    <div class="mt-3" style="margin-top: 0px;">Các ví MoMo bị thông báo "Bạn đã vượt quá số lần đăng nhập trong ngày theo quy định của Ví. Vui lòng thử lại sau 24h giờ nữa!" => Đợi qua ngày hoặc 24h ví sẽ hoạt động lại bình thường!
    </div>
</div>
<div class="alert alert-danger show flex items-center mb-2" role="alert" style="margin-bottom: 5px; justify-content:flex-start;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
    </svg>Lưu ý: Sử dụng số dư ví thần tài sẽ không truy vấn được số dư và lịch sử giao dịch taị Web2M</div>

<div class="alert alert-danger show flex items-center mb-2" role="alert" style="margin-bottom: 5px;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
    </svg>Lưu ý: Web2M nghiêm cấm sử dụng API cho mục đích vi phạm pháp luật. Web2M sẽ khóa vĩnh viễn các tài khoản sử
    dụng API cho mục đích vi phạm pháp luật và gửi thông tin đến cơ quan chức năng.</div>

<div class="alert alert-danger show flex items-center mb-2" role="alert" style="margin-bottom: 5px;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
    </svg>Lưu ý: Không đăng nhập lên thiết bị di động sau khi đã thêm trên sPayment (MoMo chỉ cho phép đăng nhập 1 thiết bị duy nhất). <br/>
Nếu thấy thông báo: "Hết thời gian truy cập! Vui lòng đăng nhập lại!" tại trang danh sách MoMo (Phần tên), vui lòng xóa ra và thêm lại. Lấy lại Token mới.</div>
    <h2 class="intro-y text-lg font-medium mt-10">
        Danh sách tài khoản MoMo
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex items-center mt-2">
            <a href="{{ route('gate.add-accounts.momo') }}">
                <button class="btn btn-primary shadow-md mr-2">Thêm tài khoản MoMo</button>
            </a>
            
        </div>
        <!-- Table Data -->
        <div class="intro-y col-span-12 overflow-auto">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th>Tên tài khoản</th>
                        <th>Số điện thoại</th>
                        <th>Số tiền</th>
                        <th>Thời gian thêm</th>
                        <th>Lần cron gần nhất</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($momoAccounts as $account)
                        <tr>
                            <td>{{ $account->account_name }}</td>
                            <td>{{ $account->phone_number }}</td>
                            <td>{{ number_format($account->balance, 2) }}</td>
                            <td>{{ $account->added_at }}</td>
                            <td>{{ $account->last_cron }}</td>
                            <td>
                                <!-- Thao tác chỉnh sửa hoặc xóa tài khoản -->
                                <a href="#">Chỉnh sửa</a> | <a href="#">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
