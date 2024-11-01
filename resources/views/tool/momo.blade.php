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
        <div class="main">
            <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Validation -->
            <div class="intro-y block" style="min-width: 591px;">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Kiểm tra lịch sử qua mã giao dịch MoMo
                    </h2>
                </div>
                <div id="form-validation" class="p-5">
                    <div class="preview">
                        <form class="validate-form" id="frmTranfer">
                            <div>
                                <div class="input-form mt-3">
                                    <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Nhập Mã giao dịch: <span
                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Mã giao dịch</span>
                                    </label>
                                    <input class="form-control" id="transid" name="transid" placeholder="Mã giao dịch"
                                        type="number" value="" required/>
                                </div>
                            </div>
                            <div id="matkhau">
                                <div class="input-form mt-3">
                                    <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Nhập Token: <span
                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Token MoMo</span>
                                    </label>
                                    <input class="form-control" id="token" name="token" placeholder="Token"
                                        type="password" value="" required/>
                                </div>
                            </div>
                            <a id="btnTransfer" class="btn btn-primary mt-5">Thực hiện</a>
                        </form>
                    </div>
                </div>
            </div>
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
                    </div>
                </div>
            </div>
            <!-- END: Form Validation -->
        </div>
        </div>
    </div>