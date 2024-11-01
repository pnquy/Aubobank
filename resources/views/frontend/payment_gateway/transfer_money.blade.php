@extends('frontend.layouts.app')


@section('content')
    <div class="transfer-money">
        <x-utils.alert type="danger" ariaLabel="{{ __('Thông báo') }}">
            {{ __('Lưu ý: Không đăng nhập lên thiết bị di động sau khi đã thêm trên API (MoMo chỉ cho phép đăng nhập 1 thiết bị duy nhất). Nếu thấy thông báo: "Hết thời gian truy cập! Vui lòng đăng nhập lại!" tại trang danh sách MoMo (Phần tên), vui lòng xóa ra và thêm lại. Lấy lại Token mới..') }}
        </x-utils.alert>

        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 col-xl-4">
                <div class="transfer-money-form-wrapper">
                    <div class="transfer-money-form-title">
                        Chuyển tiền tài khoản Momo
                    </div>

                    <x-forms.post class="transfer-money-form" noValidate
                        action="{{ route('frontend.payment_gateway.payment_gateway_account.transfer', ['paymentGateway' => $paymentGateway['brand'], 'paymentGatewayAccount' => $paymentGatewayAccount['id']]) }}">
                        <div class="transfer-money-form-input-group">
                            <label for="phoneNumber" class="transfer-money-form-input-label">
                                Số điện thoại
                            </label>
                            <input id="phoneNumber" type="number" name="phoneNumber"
                                class="form-control transfer-money-form-input"
                                placeholder="Nhập chính xác số điện thoại sử dụng Momo" readonly
                                value="{{ $paymentGatewayAccount->accountNo, old('phoneNumber') }}" />

                        </div>

                        <div class="transfer-money-form-input-group">
                            <label for="receivedPhoneNumber" class="transfer-money-form-input-label">
                                Số điện thoại người nhận
                            </label>
                            <input id="receivedPhoneNumber" type="number" name="receivedPhoneNumber"
                                class="form-control transfer-money-form-input"
                                placeholder="Nhập chính xác số điện thoại người nhận"
                                value="{{ old('receivedPhoneNumber') }}" />

                        </div>

                        <div class="transfer-money-form-input-group">
                            <label for="amountMoney" class="transfer-money-form-input-label">
                                Nhập số tiền
                            </label>
                            <input id="amountMoney" type="" name="amountMoney"
                                class="form-control transfer-money-form-input" placeholder="Số tiền nhỏ nhất là 100đ"
                                value="{{ old('amountMoney') }}" />

                        </div>


                        <div class="transfer-money-form-input-group">
                            <label for="message" class="transfer-money-form-input-label">
                                Nhập lời nhắn
                            </label>
                            <input id="message" type="text" name="message"
                                class="form-control transfer-money-form-input"
                                placeholder="Nhập lời nhắn đến người nhận (Không bắt buộc)" value="{{ old('message') }}" />

                        </div>



                        <div class="transfer-money-form-input-group">
                            <label for="password" class="transfer-money-form-input-label">
                                Mật khẩu
                            </label>
                            <input id="password" type="password" name="password"
                                class="form-control transfer-money-form-input" placeholder="Nhập mật khẩu Momo (6 chữ số)"
                                value="{{ old('password') }}" />

                        </div>


                        <div class="transfer-money-form-input-group">
                            <label for="token" class="transfer-money-form-input-label">
                                Token
                            </label>
                            <input id="token" type="text" name="token"
                                class="form-control transfer-money-form-input"
                                placeholder="Mã token tương ứng với API của Autobank" value="{{ old('token') }}" />


                        </div>

                        <button class="btn btn-primary transfer-money-form-submit-btn">Xác nhận chuyển tiền</button>

                    </x-forms.post>

                </div>
            </div>
        </div>

    </div>
    <x-utils.form-errors id="addFormError" :errors="$errors">

    </x-utils.form-errors>
@endsection
