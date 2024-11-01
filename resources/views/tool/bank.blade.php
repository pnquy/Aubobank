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
        <div class="alert alert-success show mb-2" role="alert" style="margin-bottom: 5px;">
    <div class="mt-3" style="margin-top: 0px;">Hướng dẫn sử dụng: <a href="https://web2m.com/huong-dan-su-dung-cong-cu-kiem-thu-api-ngan-hang-tai-he-thong-api-web2m/" target="_blank">https://web2m.com/huong-dan-su-dung-cong-cu-kiem-thu-api-ngan-hang-tai-he-thong-api-web2m/</a>
    </div></div>
        <div class="main">           
    <div class="intro-y col-span-12 lg:col-span-6 block">
        <!-- BEGIN: Form Validation -->
        <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    Kiểm thử API (Ngân hàng)
                </h2>
            </div>
            <div id="form-validation" class="p-5">
                <div class="preview">
                    <form class="validate-form" id="frmTranfer">
                        <div class="input-form">
                            <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Chọn ngân hàng:
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Chọn ngân hàng cần thử</span> </label><select class="form-control" id="type" onchange="checkbank()" required>
                                                                <option value="">Chọn ngân hàng cần thử</option>
                                                                <option value="acb">ACB</option>
                                                                <option value="mbbank">MBBank</option>
                                                                <option value="techcombank">Techcombank</option>
                                                                <option value="tpbank">TPBank</option>
                                                                <option value="vietcombank">Vietcombank</option>
                                                                <option value="bidv">BIDV</option>
                                                                <option value="vietinbank">Vietinbank</option>
                                    
                                                            </select>
                        </div>
                        <div class="input-form mt-3">
                            <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Chọn Version API (Chọn đúng Version đang sử dụng):
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Chọn Version API</span> </label><select class="form-control" id="version" required>
                                                                <option value="2">Version 2</option>
                                                                <option value="3">Version 3</option>
                                    
                                                            </select>
                        </div>
                        <div id="value"></div>
                      <!--  <div class="input-form mt-3">
                            <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Mật khẩu:
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Nhập mật khẩu ngân hàng</span> </label>

                            <input class="form-control" type="password" id="password" name="password"
                                placeholder="Nhập mật khẩu ngân hàng" type="password" value="" required />
                        </div>

                        <div class="input-form mt-3">
                            <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Số tài khoản: <span
                                    class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Nhập số số tài khoản ngân hàng</span> </label>
                            <input class="form-control" id="accountnumber" name="accountnumber" placeholder="Nhập số số tài khoản ngân hàng"
                                type="text" required/>

                        </div> -->
                            <div class="input-form mt-3">
                                <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Nhập Token: <span
                                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Token Ngân hàng</span>
                                </label>
                                <input class="form-control" id="token" name="token" placeholder="Token"
                                    type="password" value="" required/>
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
    </div>
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
                    <!-- END: Validation Form -->
                    <!-- BEGIN: Success Notification Content -->
                    <!-- END: Failed Notification Content -->
                </div>
            </div>
        </div>
        <!-- END: Form Validation -->
    </div>