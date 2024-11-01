@extends('frontend.layouts.app')


@section('content')
    <div class="upgrade-account">
        <div class="user-info-wrapper">
            <h2 class="user-name">{{ $user->name }}</h2>
            <h2 class="user-scoint-wrapper">
                <div class="user-scoint-left">
                    <i class="fa-solid fa-book user-scoint-icon"></i>
                </div>
                <div class="user-scoint-right">
                    <span class="user-scoint-value">{{ $user->scoint }}</span>
                    <span class="user-scoint-description">Số dư hiện tại</span>
                </div>
            </h2>
        </div>
        <div class="upgrade-account-header">
            <h1 class="upgrade-account-title">Chọn gói để gia hạn</h1>
            <p class="upgrade-account-introduction">Vui lòng chọn gói tương ứng với cổng ngân hàng sử dụng. Nạp tiền < tại
                    đây> để có sCoint gia hạn.</p>
            <button type="button" id="dipositCointBtn" class="btn btn-primary upgrade-account-topup-btn">Nạp Coin</button>
        </div>
        <div class="row upgrade-account-package-list">


            @foreach ($packages as $index => $package)
                <div class="col-xl-4 col-md-6 col-12 px-4 py-5">
                    <div class="upgrade-account-package-item" id="packageItem">
                        <div class="upgrade-account-package-header">
                            <h2 class="upgrade-account-package-name">{{ $package->name }}</h2>
                            <span class="upgrade-account-active-btn">Phổ biến</span>
                        </div>
                        <div class="upgrade-account-package-price">
                            <span class="upgrade-account-package-price-value">{{ $package->price }}</span>
                            <sup class="upgrade-account-package-price-unit">sCoint</sup>
                            <sub class="upgrade-account-package-price-month">/tháng</sub>
                        </div>
                        <div class="upgrade-account-package-payment-gateway">
                            <h3 class="upgrade-account-package-payment-gateway-title">
                                Các cổng hoạt động
                            </h3>
                            <div class="upgrade-account-package-payment-gateway-list">
                                @foreach ($package->paymentGatewayPackages as $paymentGatewayPackage)
                                    <div class="upgrade-account-active-btn">{{ $paymentGatewayPackage->usageAccountLimit }}
                                        {{ $paymentGatewayPackage->paymentGateway->brand }}</div>
                                @endforeach

                            </div>
                        </div>
                        <div class="upgrade-account-package-description">
                            <span class="upgrade-account-package-description-item">
                                @foreach (explode('. ', $package->description) as $item)
                                    {{ $item }}<br>
                                @endforeach
                            </span>
                        </div>

                        <div class="upgrade-account-package-usage-limit">

                            <x-forms.post class="upgrade-account-package-form"
                                id="upgradeUserPackageForm{{ $package->id }}"
                                action="{{ route('frontend.user_package.upgrade') }}">
                                <div class="upgrade-account-package-form-group">
                                    <h3 class="upgrade-account-package-form-label">Thời gian sử dụng:</h3>
                                    <input type="hidden" name="packageId" value="{{ $package->id }}" />
                                    <select name="timeLimit" class="form-control upgrade-account-package-form-input"
                                        id="{{ 'timeLimit' . $index }}" data-index="{{ $index }}">

                                        <option value="">Chọn thời gian sử dụng</option>
                                        @foreach (range(1, 12) as $month)
                                            <option value="{{ $month }}">{{ $month }} Tháng</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="upgrade-account-package-form-group">
                                    <h3 class="upgrade-account-package-form-label">Chọn gói tài khoản:</h3>
                                    <select name="userPackageId" class="form-control upgrade-account-package-form-input"
                                        id="{{ 'userPackage' . $index }}" data-index="{{ $index }}">

                                        <option value>Thêm gói tài khoản mới</option>
                                        @foreach ($package->userPackages as $userPackage)
                                            <option value="{{ $userPackage->id }}">
                                                {{ \Carbon\Carbon::parse($userPackage->timeStart)->format('d/m/Y') }}
                                                -
                                                {{ \Carbon\Carbon::parse($userPackage->timeEnd)->format('d/m/Y') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="upgrade-account-package-form-group payment-price-group d-none">
                                    <h3 class="upgrade-account-package-form-label">Số sCoint cần thanh toán:</h3>
                                    <input name="totalPrice" class="form-control upgrade-account-package-form-input"
                                        id="{{ 'packageTotalPrice' . $index }}" disabled />
                                    <input name="price" type="hidden" id="{{ 'price' . $index }}" disabled
                                        value="{{ $package->price }}" />
                                </div>
                                <button type="button" class="btn btn-primary upgrade-account-package-form-submit-btn"
                                    id="upgradeUserPackageFormBtn{{ $package->id }}"
                                    data-package='{"name": "{{ $package->name }}"}'
                                    data-user='{"phoneNumber": "{{ $user->phoneNumber }}"}'>
                                    Gia hạn {{ $package->name }}
                                </button>
                            </x-forms.post>


                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <x-utils.form-errors id="upgradeAccountFormError" :errors="$errors">
    </x-utils.form-errors>


    <x-info-modal.warning id="upgradeAccountSubmitModal" title="Thông báo" description="" haveBackBtn backBtnLabel="Hủy">
    </x-info-modal.warning>

    <x-info-modal.warning id="userHaveNotEnoughMoneyModal" title="Thông báo" description="" haveBackBtn backBtnLabel="Hủy">
    </x-info-modal.warning>



    @push('after-scripts')
        <script type="module">
            import {
                showInfoModal
            } from "/js/frontend/global/components/modal.js";
            $(document).ready(function() {

                let userHaveNotEnoughMoneyModal;
                if ("{{ Session::has('userHaveNotEnoughMoneyNotify') }}") {
                    userHaveNotEnoughMoneyModal = "{{ Session::get('userHaveNotEnoughMoneyNotify') }}";
                }

                if (userHaveNotEnoughMoneyModal) {
                    showInfoModal(
                        "userHaveNotEnoughMoneyModal", {
                            title: "Thông báo",
                            description: userHaveNotEnoughMoneyModal,
                        }, {
                            submitBtnLabel: "Nạp scoint"
                        },
                        () => {
                            let t = "{{ route('frontend.scoint.deposit_view') }}";
                            console.log("t: ", t);
                            window.location.href = t;
                        }
                    );
                }
            })
        </script>
        <script type="module" src="{{ mix('js/frontend/upgradeAccount.js') }}"></script>
    @endpush
@endsection
