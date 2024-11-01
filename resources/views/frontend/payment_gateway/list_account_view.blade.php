@extends('frontend.layouts.app')

@section('content')
    <?php
    use App\Models\PaymentGateway;
    use App\Models\PaymentGatewayAccount;
    use Illuminate\Support\Str;
    
    function formatTimeDiff($minutesDiff)
    {
        if ($minutesDiff === null) {
            return '';
        }
    
        if ($minutesDiff < 60) {
            return $minutesDiff . ' phút trước';
        } elseif ($minutesDiff < 1440) {
            $hours = floor($minutesDiff / 60);
            $minutes = $minutesDiff % 60;
            return $hours . ' giờ ' . $minutes . ' phút trước';
        } else {
            $days = floor($minutesDiff / 1440);
            $hours = floor(($minutesDiff % 1440) / 60);
            $minutes = $minutesDiff % 60;
            return $days . ' ngày ' . $hours . ' giờ ' . $minutes . ' phút trước';
        }
    }
    
    function getThLabel($labelPrefix, $labelKey)
    {
        $snakeLabelKey = Str::snake($labelKey);
        return __('payment_gateway.properties.' . $labelPrefix . '.' . $snakeLabelKey);
    }
    
    function getAccountTableAction($actions)
    {
        $actionObject = new \stdClass();
        $defaults = ['pause', 'fixAccount', 'update', 'receiveHistory', 'transferHistory', 'getToken', 'transferMoney', 'remove'];
        foreach ($defaults as $default) {
            $actionObject->{$default} = false;
        }
    
        foreach ($actions as $action) {
            $actionObject->{$action} = true;
        }
        return $actionObject;
    }
    
    function createData($paymentGateway)
    {
        $brand = $paymentGateway->brand;
        extract(PaymentGateway::BRANDS);
    
        $labelPrefix = '';
        $cols = [];
        $actions = null;
    
        switch ($brand) {
            case $MOMO:
            case $ZALOPAY:
            case $VIETTELPAY:
                $actions = getAccountTableAction(['pause', 'update', 'receiveHistory', 'transferHistory', 'getToken', 'transferMoney', 'remove']);
                $labelPrefix = 'wallet';
                $cols = ['accountName', 'accountNo', 'createdAt', 'lastCron'];
                break;
    
            case $THESIEURE:
                $actions = getAccountTableAction(['pause', 'fixAccount', 'getToken', 'transferMoney', 'remove']);
                $labelPrefix = 'thesieure';
                $cols = ['accountName', 'accountNo', 'createdAt', 'lastCron'];
                break;
    
            case $ACB:
            case $TECHCOMBANK:
            case $VIETCOMBANK:
            case $TPBANK:
            case $MBBANK:
            default:
                $actions = getAccountTableAction(['pause', 'getToken', 'remove']);
                $labelPrefix = 'bank';
                $cols = ['accountName', 'accountNo', 'createdAt', 'lastCron'];
                break;
        }
    
        return (object) compact('labelPrefix', 'cols', 'actions');
    }
    
    function renderSortIcon($col)
    {
        $sortBy = request()->query('sortBy');
        $sortOrder = request()->query('sortOrder');
        $sortSubKeyBy = request()->query('sortSubKeyBy');
    
        $iconClass = 'fa-solid fa-arrow-up-wide-short table-sort-icon';
        $iconClassSortDesc = 'fa-solid fa-arrow-down-wide-short table-sort-icon table-sort-icon-active';
        $iconClassSortAsc = 'fa-solid fa-arrow-up-wide-short table-sort-icon table-sort-icon-active';
    
        // dd($sortSubKeyBy);
        if ($col === $sortBy) {
            if ($sortOrder === 'DESC') {
                $iconClass = $iconClassSortDesc;
            } else {
                $iconClass = $iconClassSortAsc;
            }
        }
    
        return '<i class="' . $iconClass . '"></i>';
    }
    
    function renderTableCell($col, $paymentGatewayAccount, $paymentGateway)
    {
        if ($col === 'createdAt') {
            $value = $paymentGatewayAccount->$col;
    
            if (!empty($value) && Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value) instanceof Carbon\Carbon) {
                $formattedValue = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
                return $formattedValue;
            }
    
            return $value;
        }
    
        if ($col === 'lastCron') {
            if (!$paymentGatewayAccount?->userPackageId) {
                return 'Vui lòng mua gói ' . $paymentGateway->brand . ' để sử dụng';
            } elseif ($paymentGatewayAccount->userPackage->timeEnd < now()) {
                return 'Vui lòng gia hạn gói ' . $paymentGateway->brand . ' để sử dụng';
            }
    
            if ($paymentGatewayAccount->status === PaymentGatewayAccount::STATUSES['STOP']) {
                return 'Đăng nhập thất bại. Vui lòng thêm tài khoản lại';
            } elseif ($paymentGatewayAccount->status === PaymentGatewayAccount::STATUSES['SKIP']) {
                return 'Phiên đăng nhập hiện tại đã hết hạn. Vui lòng thêm tài khoản lại';
            } else {
                $now = new DateTime();
            } // Thời gian hiện tại
    
            $lastCron = isset($paymentGatewayAccount->$col) ? new DateTime($paymentGatewayAccount->$col) : null; // Thời gian lastCron
            // dd($lastCron);
            $minutesDiff = $lastCron ? $lastCron->diff($now)->days * 24 * 60 + $lastCron->diff($now)->h * 60 + $lastCron->diff($now)->i : null; // Số phút hoặc null
            $timeDiffString = formatTimeDiff($minutesDiff);
    
            return $timeDiffString;
        }
    
        return $paymentGatewayAccount->$col ?? '';
    }
    
    // dd($paymentGateway, $user, $user->phoneNumber, $user->phone_number, $user->firstName, $user->first_name, $user->name);
    
    $data = createData($paymentGateway);
    $labelPrefix = $data->labelPrefix;
    $cols = $data->cols;
    $actions = $data->actions;
    
    ?>

    <div class="payment-gateway-list">
        <x-utils.alert type="success" ariaLabel="{{ __('Thông báo') }}">
            {{ __('Để bật tính năng bảo mật chống trộm tiền trên MoMo, vui lòng dùng số điện thoại đăng ký (Số điện thoại đăng nhập) soạn tin SMS nội dung: BATBAOMAT và gửi đến 0123456789') }}
        </x-utils.alert>

        <x-utils.alert type="danger" ariaLabel="{{ __('Thông báo') }}">
            {{ __('Lưu ý: AutoBank nghiêm cấm sử dụng API cho mục đích vi phạm pháp luật. AutoBank sẽ khóa vĩnh viễn các tài khoản sử dụng API cho mục đích vi phạm pháp luật.') }}
        </x-utils.alert>


        <div class="payment-gateway-top">
            <h2 class="mb-4 payment-gateway-title">
                Danh sách tài khoản {{ $paymentGateway->name }}
            </h2>
            <a class="btn btn-primary payment-gateway-add-btn"
                href="{{ route('frontend.payment_gateway.add', ['paymentGateway' => $paymentGateway['brand']]) }}">
                Thêm tài khoản {{ $paymentGateway->brand }}
            </a>
        </div>

        <div class="payment-gateway-bottom">
            <x-forms.get class="payment-gateway-filter" id="paymentGatewayFilterForm">
                <input type="search" name="search"
                    class="form-control form-control-sm payment-gateway-filter-search-input"
                    placeholder="Tìm kiếm tài khoản" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">

                <i class="fas fa-search payment-gateway-filter-search-icon"></i>
            </x-forms.get>


            <div class="payment-gateway-table-wrapper">
                <table class="table table-striped payment-gateway-table" id="paymentGatewayAccountsTable" role="grid"
                    aria-describedby="table-info">
                    <thead>
                        <tr role="row">
                            @foreach ($cols as $col)
                                <th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1"
                                    data-sortBy="{{ $col }}" {{-- data-sortSubKeyBy="{{ $col->subKey }}" --}}>
                                    {{ getThLabel($labelPrefix, $col) }}
                                    {!! renderSortIcon($col) !!}
                                </th>
                            @endforeach
                            <th class="" tabindex="0" aria-controls="example" rowspan="1" colspan="1">
                                Thao tác
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymentGatewayAccounts as $paymentGatewayAccount)
                            <?php
                            // dd($paymentGatewayAccount?->accountData);
                            ?>
                            <tr role="row">
                                @foreach ($cols as $col)
                                    <td>
                                        {!! renderTableCell($col, $paymentGatewayAccount, $paymentGateway) !!}
                                    </td>
                                @endforeach

                                <td class="text-center payment-gateway-table-cell-action">
                                    <div class="payment-gateway-table-action">
                                        @if ($actions?->pause === true)
                                            <x-forms.post class="pausePaymentGatewayAccountForm"
                                                action="{{ route('frontend.payment_gateway.payment_gateway_account.pause', ['paymentGateway' => $paymentGateway['brand'], 'paymentGatewayAccount' => $paymentGatewayAccount['id']]) }}"
                                                noValidate>
                                                @if ($paymentGatewayAccount?->pause === false)
                                                    @if (is_null($paymentGatewayAccount->userPackageId))
                                                        <a class="btn bg-primary text-white payment-gateway-table-action-btn"
                                                            href="{{ route('frontend.upgrade') }}">
                                                            <i
                                                                class="fa-solid fa-cart-shopping payment-gateway-table-action-btn-icon"></i>
                                                            Mua Ngay</a>
                                                    @elseif ($paymentGatewayAccount->userPackage->timeEnd < now())
                                                        <a class="btn bg-primary text-white payment-gateway-table-action-btn"
                                                            href="{{ route('frontend.upgrade') }}">
                                                            <i
                                                                class="fa-solid fa-cart-shopping payment-gateway-table-action-btn-icon"></i>
                                                            Gia hạn</a>
                                                    @else
                                                        <button type="button" id="pausePaymentGatewayAccountBtn"
                                                            data-current-pause="{{ $paymentGatewayAccount->pause }}"
                                                            class="btn bg-danger payment-gateway-table-action-btn pausePaymentGatewayAccountBtn">
                                                            <i
                                                                class="fas fa-pause text-white payment-gateway-table-action-btn-icon"></i>
                                                            <span class="text-white">
                                                                Tạm dừng
                                                            </span>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button type="button" id="pausePaymentGatewayAccountBtn"
                                                        data-current-pause="{{ $paymentGatewayAccount?->pause }}"
                                                        class="btn bg-info payment-gateway-table-action-btn pausePaymentGatewayAccountBtn">
                                                        <i
                                                            class="fas fa-bolt text-white payment-gateway-table-action-btn-icon"></i>
                                                        <span class="text-white">
                                                            Kích hoạt
                                                        </span>
                                                    </button>
                                                @endif
                                            </x-forms.post>
                                        @endif
                                        @if ($actions?->fixAccount === true)
                                            <button class="btn payment-gateway-table-action-btn"
                                                class="fas fa-gear payment-gateway-table-action-btn-icon"></i>
                                                Sửa tài khoản
                                            </button>
                                        @endif


                                        @if ($actions?->update === true)
                                            <x-forms.post id="updatePaymentGatewayAccountForm"
                                                action="{{ route('frontend.payment_gateway.payment_gateway_account.update_info', ['paymentGateway' => $paymentGateway['brand'], 'paymentGatewayAccount' => $paymentGatewayAccount['id']]) }}"
                                                noValidate>
                                                <button type="submit" class="btn payment-gateway-table-action-btn">
                                                    <i class="fas fa-clock  payment-gateway-table-action-btn-icon"></i>
                                                    Cập nhật
                                                </button>
                                            </x-forms.post>
                                        @endif
                                        @if ($actions?->receiveHistory === true)
                                            <a class="btn payment-gateway-table-action-btn"
                                                href="{{ route('frontend.payment_gateway.payment_gateway_account.receive_history', ['paymentGateway' => $paymentGateway['brand'], 'paymentGatewayAccount' => $paymentGatewayAccount['id']]) }}">
                                                <i class="fas fa-list  payment-gateway-table-action-btn-icon"></i>
                                                LS nhận tiền
                                            </a>
                                        @endif
                                        @if ($actions?->transferHistory === true)
                                            <a class="btn payment-gateway-table-action-btn"
                                                href="{{ route('frontend.payment_gateway.payment_gateway_account.transfer_history', ['paymentGateway' => $paymentGateway['brand'], 'paymentGatewayAccount' => $paymentGatewayAccount['id']]) }}">
                                                <i class="fas fa-list  payment-gateway-table-action-btn-icon"></i>
                                                LS chuyển tiền
                                            </a>
                                        @endif
                                        @if ($actions?->getToken === true)
                                            <x-forms.post
                                                action="{{ route('frontend.payment_gateway.payment_gateway_account.get_token', ['paymentGateway' => $paymentGateway['brand'], 'paymentGatewayAccount' => $paymentGatewayAccount['id']]) }}"
                                                noValidate>
                                                <button class="btn payment-gateway-table-action-btn">
                                                    <i class="fas fa-envelope  payment-gateway-table-action-btn-icon"></i>
                                                    Lấy token
                                                </button>
                                            </x-forms.post>
                                        @endif
                                        @if ($actions?->transferMoney === true)
                                            <a class="btn payment-gateway-table-action-btn"
                                                href="{{ route('frontend.payment_gateway.payment_gateway_account.transfer_money', ['paymentGateway' => $paymentGateway['brand'], 'paymentGatewayAccount' => $paymentGatewayAccount['id']]) }}">
                                                <i class="fas fa-dollar-sign  payment-gateway-table-action-btn-icon"></i>
                                                Chuyển tiền
                                            </a>
                                        @endif
                                        @if ($actions?->remove === true)
                                            <x-forms.post id="deletePaymentGatewayAccountForm"
                                                action="{{ route('frontend.payment_gateway.payment_gateway_account.delete', ['paymentGateway' => $paymentGateway['brand'], 'paymentGatewayAccount' => $paymentGatewayAccount['id']]) }}"
                                                noValidate>
                                                <button type="button" id="deletePaymentGatewayAccountBtn"
                                                    class="btn text-danger payment-gateway-table-action-btn deletePaymentGatewayAccountBtn">
                                                    <i class="fas fa-trash payment-gateway-table-action-btn-icon"></i>
                                                    <span class="text-danger">
                                                        Xóa
                                                    </span>
                                                </button>
                                            </x-forms.post>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>




                </table>
            </div>

            <x-utils.pagination :paginationData="$paymentGatewayAccounts" />



        </div>
    </div>


    <x-info-modal.success id="notifyInfoModal" title="" description="">
    </x-info-modal.success>

    <x-info-modal.success id="getTokenModal" title="" description="">
    </x-info-modal.success>

    <x-info-modal.warning id="pauseAccountModal" title="Thông báo" description="Bạn chắc chắn muốn tạm dừng tài khoản này">
    </x-info-modal.warning>

    <x-info-modal.warning id="deleteAccountModal" title="Thông báo" description="Bạn chắc chắn muốn Xóa tài khoản này"
        haveBackBtn>
    </x-info-modal.warning>

    <x-info-modal.warning id="pauseAccountModal" title="Thông báo" description="" haveBackBtn>
    </x-info-modal.warning>



    @push('after-scripts')
        <script type="module">
            import {
                initInfoModal,
                showInfoModal,
                customSubmitInfoModalBtn
            } from "/js/frontend/global/components/modal.js"

            $(document).ready(function() {

                if ("{{ Session::has('notifyInfo') }}") {
                    showInfoModal("notifyInfoModal", {
                        title: "Thành công",
                        description: "{{ Session::get('notifyInfo') }}"
                    })
                }



                const paymentGatewayAccountsTableEle = $("#paymentGatewayAccountsTable");

                paymentGatewayAccountsTableEle.find(".table-sort-icon").on("click", function() {
                    const tableThEle = $(this).closest("th");
                    const sortBy = tableThEle.attr("data-sortBy");
                    const sortSubKeyBy = tableThEle.attr("data-sortSubKeyBy");
                    let sortOrder = "ASC"; // Mặc định là ASC

                    if ($(this).hasClass("fa-arrow-up-wide-short") && $(this).hasClass(
                            "table-sort-icon-active")) {
                        sortOrder = "DESC";
                    } else if ($(this).hasClass("fa-arrow-down-wide-short") && $(this).hasClass(
                            "table-sort-icon-active")) {
                        sortOrder = "ASC";
                    }

                    const searchParams = new URLSearchParams(window.location.search);
                    searchParams.set("sortBy", sortBy);
                    searchParams.set("sortOrder", sortOrder)
                    const newURL = window.location.pathname + '?' + searchParams.toString();
                    window.location.href = newURL;


                });


                paymentGatewayAccountsTableEle.find(".deletePaymentGatewayAccountBtn").on("click", function() {
                    showInfoModal("deleteAccountModal");
                    console.log("delete modal");

                    const deletePaymentGatewayAccountForm = $(this).closest("#deletePaymentGatewayAccountForm");

                    customSubmitInfoModalBtn("deleteAccountModal", function() {
                        console.log("delete");

                        deletePaymentGatewayAccountForm.submit();
                    })

                })



                paymentGatewayAccountsTableEle.find(".pausePaymentGatewayAccountBtn").on("click", function() {
                    console.log("pause modal click");

                    const currentPause = $(this).attr("data-current-pause");
                    console.log("currentPause: ", currentPause)
                    console.log("currentPause === '1': ", currentPause === "1")
                    console.log("currentPause === 1: ", currentPause === 1)
                    // Đang Pause
                    if (currentPause === "1") {
                        showInfoModal("pauseAccountModal", {
                            description: "Bạn có chắn chắn kích hoạt lại tài khoản này"
                        });

                    } else {

                        showInfoModal("pauseAccountModal", {
                            description: "Bạn có chắn chắn tạm dừng tài khoản này"
                        });
                    }


                    const pausePaymentGatewayAccountForm = $(this).closest(".pausePaymentGatewayAccountForm");


                    customSubmitInfoModalBtn("pauseAccountModal", function() {
                        console.log("pause");

                        pausePaymentGatewayAccountForm.submit();
                    })

                })




            })
        </script>
    @endpush
@endsection
