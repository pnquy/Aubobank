<!-- resources/views/gate/add-accounts/add-account.blade.php -->
@extends('gate.add-accounts.index') <!-- Kế thừa layout cha -->

@section('title', 'Thêm tài khoản MoMo') <!-- Đặt tiêu đề cho trang -->

@section('content')
<div class="alert alert-danger show flex items-center mb-2" role="alert" style="margin-bottom: 5px;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
    </svg>Lưu ý: Không đăng nhập lên thiết bị di động sau khi đã thêm trên API (MoMo chỉ cho phép đăng nhập 1 thiết bị duy nhất). <br/>
Nếu thấy thông báo: "Hết thời gian truy cập! Vui lòng đăng nhập lại!" tại trang danh sách MoMo (Phần tên), vui lòng xóa ra và thêm lại. Lấy lại Token mới.</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9">
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="col-span-12 mt-8">
                    <!-- BEGIN: Form Validation -->
                    <div class="intro-y box block">
                        <div class="flex flex-col sm:flex-row items-center p-3 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">Thêm tài khoản MoMo</h2>
                            <br/>(Phí 10.000 sCoin/lần)
                        </div>
                        <div id="form-validation" class="p-5">
                            <div class="preview">
                                <!-- BEGIN: Validation Form -->
                                <form action="{{ url('/momo-accounts/add') }}" method="POST" class="validate-form">
                                    @csrf <!-- CSRF protection -->
                                    <div class="input-form">
                                        <label for="phone" class="form-label">Số điện thoại:</label>
                                        <input id="phone" type="text" name="phone" class="form-control" required>
                                        @error('phone')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="input-form mt-3">
                                        <label for="pass" class="form-label">Mật khẩu:</label>
                                        <input id="pass" type="password" name="pass" class="form-control" required>
                                        @error('pass')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="input-form mt-5" style="display: flex; align-items:flex-start; gap: 10px;">
                                        <input class="form-check-input" type="checkbox" id="privacy-policy" value="false" onchange="if(this.checked) this.value='true'; else this.value='false';" tabindex="4" />
                                            <label class="form-check-label" for="privacy-policy">
                                                Bằng cách cung cấp thông tin đăng nhập cho sPayment. Bạn đã đồng ý với <a href="https://api.web2m.com/chinh-sach-bao-mat.html" target="_blank">Chính Sách Bảo mật</a> tại FUTE và đang cho phép sPayment truy xuất và quản lý dữ liệu tài chính của mình.<br/>
                                            </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-5">Lấy mã OTP</button>
                                </form>
                                <!-- END: Validation Form -->
                            </div>
                        </div>
                    </div>
                    <!-- END: Form Validation -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
