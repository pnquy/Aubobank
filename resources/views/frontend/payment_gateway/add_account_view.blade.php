@extends('frontend.layouts.app')


@section('content')
    <?php
    
    use App\Helpers\PaymentGatewayHelper;
    use Illuminate\Support\Str;
    
    function getFormInputText($paymentGatewayType, $labelKey, $appName)
    {
        return __(Str::snake('payment_gateway.add.form.' . $paymentGatewayType . '.' . $labelKey), ['app_name' => ucfirst($appName)]);
    }
    
    function getPageText($key)
    {
        return __(Str::snake('payment_gateway.add.' . $key));
    }
    
    $data = PaymentGatewayHelper::createDataForAddPaymentGatewayAccount($paymentGateway);
    
    $paymentGatewayType = $data->paymentGatewayType;
    $inputs = $data->inputs;
    
    ?>

    <div class="add-payment-gateway">

        <x-utils.alert type="danger" ariaLabel="{{ __('Thông báo') }}">
            {{ __('Lưu ý: Không đăng nhập lên thiết bị di động sau khi đã thêm trên API (MoMo chỉ cho phép đăng nhập 1 thiết bị duy nhất). Nếu thấy thông báo: "Hết thời gian truy cập! Vui lòng đăng nhập lại!" tại trang danh sách MoMo (Phần tên), vui lòng xóa ra và thêm lại. Lấy lại Token mới..') }}
        </x-utils.alert>

        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 col-xl-4">
                <div class="add-payment-gateway-form-wrapper">
                    <div class="add-payment-gateway-form-title">
                        Thêm tài khoản {{ $paymentGateway->name }}
                    </div>
                    @if (!Session::has('addAccountStep'))
                        <x-forms.post class="add-payment-gateway-form"
                            action="{{ route('frontend.payment_gateway.add_account', ['paymentGateway' => $paymentGateway['brand']]) }}"
                            noValidate>
                            @foreach ($inputs as $input)
                                <div class="add-payment-gateway-form-input-group">
                                    <label for="{{ $input->name }}" class="add-payment-gateway-form-input-label">
                                        {{ getFormInputText($paymentGatewayType, $input->name . '.label', $paymentGateway->brand) }}
                                    </label>
                                    <input id="{{ $input->name }}" type="{{ $input->type }}" name="{{ $input->name }}"
                                        class="form-control add-payment-gateway-form-input"
                                        placeholder="{{ getFormInputText($paymentGatewayType, $input->name . '.placeholder', $paymentGateway->brand) }}"
                                        value="{{ old($input->name) }}" />
                                </div>
                            @endforeach
                            <button
                                class="btn btn-primary add-payment-gateway-form-submit-btn">{{ getPageText('form.' . $paymentGatewayType . '.button.add') }}</button>
                        </x-forms.post>
                    @elseif (Session::get('addAccountStep') === 'otp')
                        <x-forms.post class="add-payment-gateway-form"
                            action="{{ route('frontend.payment_gateway.add_account_otp_verify', ['paymentGateway' => $paymentGateway['brand']]) }}"
                            noValidate>
                            @foreach ($inputs as $input)
                                <div class="add-payment-gateway-form-input-group">
                                    <label for="{{ $input->name }}" class="add-payment-gateway-form-input-label">
                                        {{ getFormInputText($paymentGatewayType, $input->name . '.label', $paymentGateway->brand) }}
                                    </label>
                                    <input id="{{ $input->name }}" type="{{ $input->type }}" name="{{ $input->name }}"
                                        class="form-control add-payment-gateway-form-input"
                                        placeholder="{{ getFormInputText($paymentGatewayType, $input->name . '.placeholder', $paymentGateway->brand) }}"
                                        value="{{ old($input->name) }}" readonly />
                                </div>
                            @endforeach
                            <div class="add-payment-gateway-form-input-group">
                                <label for="otp" class="add-payment-gateway-form-input-label">
                                    {{ getFormInputText($paymentGatewayType, 'otp' . '.label', $paymentGateway->brand) }}
                                </label>
                                <input id="otp" type="text" name="otp"
                                    class="form-control add-payment-gateway-form-input"
                                    placeholder="{{ getFormInputText($paymentGatewayType, 'otp' . '.placeholder', $paymentGateway->brand) }}" />
                            </div>
                            <button
                                class="btn btn-primary add-payment-gateway-form-submit-btn">{{ getPageText('form.' . $paymentGatewayType . '.button.sendOtp') }}</button>
                        </x-forms.post>
                    @endif



                </div>
            </div>
        </div>

    </div>



    @if (Session::has('updateAccountId'))
        {{-- <x-forms.post class="add-payment-gateway-form" id="updateAccountForm"
            action="{{ route('frontend.payment_gateway.payment_gateway_account.update', ['paymentGateway' => $paymentGateway['brand'], 'paymentGatewayAccount' => Session::get('updateAccountId')]) }}"
            noValidate>
            <input type="hidden" name="password" class="form-control add-payment-gateway-form-input"
                value="{{ old('password') }}" readonly />
        </x-forms.post> --}}

        <x-forms.post class="add-payment-gateway-form" id="updateAccountForm"
            action="{{ route('frontend.payment_gateway.payment_gateway_account.update', ['paymentGateway' => $paymentGateway['brand'], 'paymentGatewayAccount' => Session::get('updateAccountId')]) }}"
            noValidate>
            @foreach ($inputs as $input)
                <div class="add-payment-gateway-form-input-group">
                    <input type="hidden" name="{{ $input->name }}" class="form-control add-payment-gateway-form-input"
                        value="{{ old($input->name) }}" />
                </div>
            @endforeach
        </x-forms.post>
    @endif




    <x-utils.form-errors id="addFormError" :errors="$errors">

    </x-utils.form-errors>

    <x-info-modal.success id="notifyInfoModal" title="" description="">
    </x-info-modal.success>

    <x-info-modal.danger id="addAccountFailModal" title="Lỗi" description="{{ Session::get('addAccountFail') }}">
    </x-info-modal.danger>


    <x-info-modal.warning id="updateAccountModal" title="Thông báo" description="" haveBackBtn>
    </x-info-modal.warning>




    @push('after-scripts')
        <script type="module">
            import { initInfoModal, showInfoModal, customSubmitInfoModalBtn  } from "/js/frontend/global/components/modal.js"

             $(document).ready(function() {
                if ("{{ Session::has('updateAccountNotify') }}") {
                    showInfoModal("updateAccountModal", {
                            title: "Thành công",
                            description: "{{ Session::get('updateAccountNotify') }}"
                        },
                        { submitBtnLabel: "Cập nhật" },
                        () => {
                            const updateAccountForm = $('#updateAccountForm');
                            updateAccountForm.submit();
                        }
                    )
                }
            })
        </script>
    @endpush
@endsection
