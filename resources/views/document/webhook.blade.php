<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordpress</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/profile.scss','resources/sass/webhook.scss', 'resources/js/webhook.js', 'resources/sass/apidata.scss'])
</head>

<body style="background-color: #189444;">
    @include('layouts.menu')

    <div class="profile" style="background-color: #f1f5f8;">
        @include('layouts.navigation')
        <div class="main webhook">
            <div class="box">
                <div class="API-items">
                    <h1 class="api-title" data-api="webhook">Tài liệu Webhook</h1>
                    <div class="api-content">
                        <div><p><strong>A. TỔNG QUAN</strong></p>
                        <ul>
                            <li>Loại sự kiện: các loại sự kiện sẽ được gửi cho khách hàng sau khi cài đặt cấu hình thành công.</li>
                            <li>Webhook url: đường dẫn khách hàng cung cấp, nhận data Web2M gửi sang khi sự kiện xảy ra.</li>
                        </ul>
                        <p><strong>B. CẤU HÌNH WEBHOOK</strong></p>
                        <ol>
                            <li>Vào trang Cấu hình webhook, click vào button  <button onclick="window.location.href='/Home/Addcallback'" class="btn btn-primary shadow-md mr-2">Thêm mới</button></li>
                            <li>Bổ sung thông tin vào cấu hình Webhook</li>
                        </ol>
                        <p>Mở ra cấu hình webhook trong trang thêm Webhook:</p>
                        <ul>
                            <li>Ngân hàng: Chọn ngân hàng muốn thêm.</li>
                            <li>Webhook URL: Nhập đường dẫn. Đây là địa chỉ Webhook callback URL (bắt buộc chạy https)</li>
                            
                        </ul>
                        <p><strong>C. Lưu ý</strong></p>
                        <ul>
                            <li>Phải là đường dẫn công khai có thể truy cập từ internet</li>
                            <li>Đường dẫn sử dụng giao thức bảo mật HTTPS</li>
                            <li>Cần xác thực dữ liệu Token trước khi lưu dữ liệu</li>
                            <li>Sau khi xử lý, webhook của bạn phải phản hồi với status code là 200 OK. Và đáp ứng thời gian phản hồi dưới 5 giây ( Web2M sẽ thiết lập timeout cho request post bắn webhook là 5s)</li>
                        </ul></div>
                        <h2 class="api-subtitle">URL API</h2>
                        <div class="api-url">
                            <span class="url-part url-base">https://</span>
                            <span class="url-part url-path">api.web2m.com/historyapimomo/token</span>
                        </div>

                        <table class="api-table">
                            <tr>
                                <th>Tham số</th>
                                <th>Dữ liệu</th>
                                <th>Ví dụ</th>
                                <th>Chú thích</th>
                            </tr>
                            <tr>
                                <td>Token</td>
                                <td>string</td>
                                <td>39D6670A-1B9A-A12B-ADB0-DB020B35F5CF</td>
                                <td>Token của tài khoản momo cần GET</td>
                            </tr>
                        </table>
                        @include('document.repose-webhook')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>