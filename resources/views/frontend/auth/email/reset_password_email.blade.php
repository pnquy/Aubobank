<div style="color: #000;">
    <h2 style="color: #000; font-weight: bold;">Yêu cầu reset mật khẩu tài khoản:</h2>

    <p>Vui lòng copy đoạn mã chúng tôi gửi dưới đây sau đó quay lại form yêu cầu reset mật khẩu để tiến hành khôi phục
        mật
        khẩu mới.</p>

    <p style="color: red; font-weight: bold;">{{ $token }}</p>

    <p>Nếu không muốn copy mã bạn có thể truy cập đường link sau:</p>

    <p><a href="{{ $resetPasswordUrl }}">{{ $resetPasswordUrl }}</a></p>

    <p style="text-decoration: underline;">Lưu ý:</p>Mã xác nhận chỉ có giá trị trong vòng 5 phút.</p>

    <p>Trân trọng,</p>
    <p>Auto Bank App</p>
</div>
