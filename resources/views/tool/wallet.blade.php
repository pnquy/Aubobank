<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordpress</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/profile.scss','resources/sass/tool.scss'])
</head>

<body style="background-color: #189444;">
    @include('layouts.menu')

    <div class="profile" style="background-color: #f1f5f8;">
        @include('layouts.navigation')
        <div class="alert" style="margin-top: 0px;">Hướng dẫn sử dụng: <a href="https://web2m.com/huong-dan-su-dung-cong-cu-kiem-thu-api-vi-dien-tu-tai-he-thong-api-web2m/" target="_blank">https://web2m.com/huong-dan-su-dung-cong-cu-kiem-thu-api-vi-dien-tu-tai-he-thong-api-web2m/</a>
    </div>
        <div class="main">
            <div class="intro-y box block">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    Kiểm thử API (Ví điện tử)
                </h2>
            </div>
            <div id="form-validation" class="p-5">
                <div class="preview">
                    <form class="validate-form" id="frmTranfer">
                        <div class="input-form">
                            <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Chọn loại ví:
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Chọn loại ví cần thử</span> </label><select class="form-control" id="type" required>
                                                                <option value="">Chọn Ví cần thử</option>
                                                                <option value="momo">MoMo</option>
                                                                <option value="zalopay">ZaloPay</option>
                                                                <option value="thesieure">Thẻ siêu rẻ</option>
                                                            </select>
                        </div>
                        <div id="matkhau">
                            <div class="input-form mt-3">
                                <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Nhập Token: <span
                                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Token Ví điện tử</span>
                                </label>
                                <input class="form-control" id="token" name="token" placeholder="Token"
                                    type="password" value="" required/>
                            </div>
                        </div>
                        <a id="btnTransfer" class="btn btn-primary mt-5">Thực hiện</a>
                    </form>
                    <!-- END: Validation Form -->
                    <!-- BEGIN: Success Notification Content -->
                    <!-- END: Failed Notification Content -->
                </div>
            </div>
        </div>
        <!-- END: Form Validation -->
    <div class="intro-y col-span-12 lg:col-span-6 block">
        <!-- BEGIN: Form Validation -->
        <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    Kết quả
                </h2>
            </div>
            <div id="form-validation" class="p-5">
                <div class="preview">
                    <div id="trangthai"></div>
                </div>
            </div>
        </div>
        <!-- END: Form Validation -->
    </div>
        </div>