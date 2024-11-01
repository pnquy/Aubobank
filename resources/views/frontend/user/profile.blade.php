@extends('frontend.layouts.app')



@section('content')
    <?php
    // dd($user->otpVerifyLoginPause);
    // dd($user->otpVerifyLoginPause == true);
    ?>
    <div class="account">
        <div class="account-header">
            <h1 class="account-title">
                Hồ sơ cá nhân
            </h1>
        </div>
        <div class="account-content">
            <div class="row">
                <div class="col-lg-3 col-12">
                    @include('frontend.user.includes.account_card_menu')
                    <div class="card account-card">
                        <div class="card-header account-card-header">
                            <div class="account-card-header-left">
                                <h1 class="account-card-header-title">
                                    Thông tin kích hoạt
                                </h1>
                            </div>
                            <div class="account-card-header-right"></div>
                        </div>
                        <div class="card-body account-card-body">
                            @foreach ($packages as $package)
                                <div class="account-card-form-group">
                                    <span class="account-card-form-label">Thời hạn sử dụng
                                        <span class="text-primary font-weight-bold">
                                            {{ $package->name }}</span>:
                                    </span>

                                    @foreach ($package->userPackages as $userPackage)
                                        @php
                                            $timeEnd = \Carbon\Carbon::parse($userPackage->timeEnd)->format('H:i:s d/m/Y');
                                            $daysDifference = \Carbon\Carbon::parse($userPackage->timeEnd)->diffInDays(\Carbon\Carbon::now());
                                            $isWarning = $daysDifference <= 7;
                                        @endphp
                                        <input type="text"
                                            class="form-control account-card-form-input{{ $isWarning ? ' border border-warning' : '' }}"
                                            value="{{ $timeEnd }}" disabled>
                                    @endforeach


                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-12">
                    <div class="card account-card">
                        <div class="card-header account-card-header">
                            <div class="account-card-header-left">
                                <h1 class="account-card-header-title">
                                    Access Key
                                </h1>
                            </div>
                            <div class="account-card-header-right">
                                <span class="text-primary" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#accountAccessTokenOffcanvasRight">
                                    (Access Key là gì?)
                                </span>
                            </div>

                            <div class="offcanvas offcanvas-end account-access-token-offcanvas" tabindex="-1"
                                id="accountAccessTokenOffcanvasRight" aria-labelledby="offcanvasRightLabel"
                                style="width: 500px;">
                                <div class="offcanvas-header account-access-token-header">
                                    <h2 id="offcanvasRightLabel" class="account-access-token-title">Access Key</h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                </div>
                                <ul class="offcanvas-body account-access-token-body">
                                    <li class="account-access-token-body-item">&#x25CF; Key dùng để xác thực sCoint cũng như
                                        truy vấn
                                        lịch su sCoint.</li>
                                    <li class="account-access-token-body-item">&#x25CF; Key dùng để truy cập tài khoản tại
                                        Web2M từ
                                        xa thông qua các API tài khoản.</li>
                                    <li class="account-access-token-body-item">&#x25CF; Access Key không phải là Token của
                                        ngân hàng
                                        và không thể thay thế token của ngân
                                        hàng.</li>



                                </ul>
                            </div>

                        </div>
                        <div class="card-body account-card-body">

                            <div class="account-card-form-group">
                                <div class="input-group account-card-form-input-group">
                                    <input type="text" class="form-control account-card-form-input"
                                        value="{{ $user->accessToken }}" disabled>
                                    <button class="btn btn-primary text-white account-card-form-input-append-btn">
                                        Đổi key
                                    </button>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="card account-card">
                        <div class="card-header account-card-header">
                            <div class="account-card-header-left">
                                <h1 class="account-card-header-title">
                                    Thông tin cá nhân

                                </h1>
                            </div>

                        </div>

                        <x-forms.post class="card-body account-card-body" id="updateProfileForm"
                            action="{{ route('frontend.user.update_profile') }}">
                            <div class="row">
                                <div class="col-lg-10 col-12">
                                    <div class="row">

                                        <div class="col-lg-6 col-12">
                                            <div class="account-card-form-group">
                                                <span class="account-card-form-label">Họ</span>
                                                <input type="text" class="form-control account-card-form-input"
                                                    value="{{ $user->lastName }}" name="lastName">

                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="account-card-form-group">
                                                <span class="account-card-form-label">Tên</span>
                                                <input type="text" class="form-control account-card-form-input"
                                                    value="{{ $user->firstName }}" name="firstName">

                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <div class="account-card-form-group">
                                                <span class="account-card-form-label">Số điện thoại</span>
                                                <input type="text" class="form-control account-card-form-input"
                                                    value="{{ $user->phoneNumber }}" disabled>

                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="account-card-form-group">
                                                <span class="account-card-form-label">Email</span>
                                                <input type="text" class="form-control account-card-form-input"
                                                    value="{{ $user->email }}" disabled>

                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="account-card-form-group">
                                                <span class="account-card-form-label">Tên tổ chức</span>
                                                <input type="text" class="form-control account-card-form-input"
                                                    value="{{ old('company', $user->company) }}" name="company">


                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="account-card-form-group">
                                                <span class="account-card-form-label">Địa chỉ</span>
                                                <input type="text" class="form-control account-card-form-input"
                                                    value="{{ $user->address }}" name="address">

                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="account-card-form-group">
                                                <span class="account-card-form-label">Bật tắt tính năng OTP Xác thực
                                                    đăng
                                                    nhập</span>
                                                <select class="form-control account-card-form-input"
                                                    name="otpVerifyLoginPause">

                                                    @foreach ([['value' => 0, 'label' => 'Bật'], ['value' => 1, 'label' => 'Tắt']] as $option)
                                                        <option value="{{ $option['value'] }}"
                                                            {{ $user->otpVerifyLoginPause == $option['value'] ? 'selected' : '' }}>
                                                            {{ $option['label'] }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>

                                        </div>




                                    </div>
                                </div>
                                <div class="col-lg-2 col-12">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRY5AsGV-I02FwBi5MBTpcDAMgcLNd5c-qA3A&usqp=CAU"
                                        style="width: 100%;" alt="User" />
                                </div>
                            </div>

                            <div class="account-card-body-footer">
                                <button class="btn btn-primary account-card-form-submit-btn" type="submit">
                                    Lưu
                                </button>
                            </div>
                        </x-forms.post>
                    </div>



                    <div class="card account-card">
                        <div class="card-header account-card-header">
                            <div class="account-card-header-left">
                                <h1 class="account-card-header-title">
                                    Thiết lập nâng cao
                                </h1>
                            </div>

                        </div>
                        <x-forms.post class="card-body account-card-body" id="updateAdvancedProfileForm"
                            action="{{ route('frontend.user.update_profile') }}">
                            <div class="row">
                                <div class="col-6">
                                    <div class="account-card-form-group">
                                        <span class="account-card-form-label">Bật tắt tính năng thông báo Telegram</span>

                                        <select class="form-control account-card-form-input"
                                            name="telegramNotificationPause">

                                            @foreach ([['value' => 0, 'label' => 'Bật'], ['value' => 1, 'label' => 'Tắt']] as $option)
                                                <option value="{{ $option['value'] }}"
                                                    {{ $user->telegramNotificationPause == $option['value'] ? 'selected' : '' }}>
                                                    {{ $option['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="account-card-form-group">
                                        <span class="account-card-form-label">Telegram Group ID</span>
                                        <input type="text" class="form-control account-card-form-input"
                                            value="{{ $user->telegramGroupId }}" name="telegramGroupId">

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="account-card-form-group">
                                        <span class="account-card-form-label">Telegram Token</span>
                                        <input type="text" class="form-control account-card-form-input"
                                            value="{{ $user->telegramToken }}" name="telegramToken">
                                    </div>
                                </div>

                            </div>

                            <div class="account-card-body-footer">
                                <button class="btn btn-primary account-card-form-submit-btn" type="submit">
                                    Lưu
                                </button>
                            </div>
                    </div>
                    </x-forms.post>


                    <div class="card account-card">
                        <div class="card-header account-card-header">
                            <div class="account-card-header-left">
                                <h1 class="account-card-header-title">
                                    Nhật ký hoạt động
                                </h1>
                            </div>

                        </div>
                        <div class="card-body account-card-body">
                            <div class="account-activity-log">
                                <div class="account-activity-log-filter">
                                    <div class="account-activity-log-filter-group">
                                        <input type="search" name="search"
                                            class="form-control account-activity-log-filter-search-input"
                                            placeholder="Tìm kiếm tài khoản"
                                            value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">

                                        <i class="fas fa-search account-activity-log-filter-search-icon"></i>

                                    </div>
                                </div>
                                <div class="account-activity-log-table">

                                </div>

                                <div class="account-activity-log-table-wrapper">
                                    <?php
                                    $heads = ['STT', 'Hành động', 'Loại', 'IP Address', 'Thời gian', 'Trạng thái'];
                                    $data = [
                                        (object) [
                                            'activity' => 'Cập nhật hồ sơ cá nhân',
                                            'type' => 'Cập nhật',
                                            'ipAddress' => '127.168.0.1',
                                            'time' => '2023-06-01 18:16:20',
                                            'status' => 'success',
                                        ],
                                    
                                        (object) [
                                            'activity' => 'Cập nhật hồ sơ cá nhân',
                                            'type' => 'Cập nhật',
                                            'ipAddress' => '135.159.0.1',
                                            'time' => '2023-06-21 15:16:17',
                                            'status' => 'fail',
                                        ],
                                    ];
                                    
                                    function renderStatusClass($status)
                                    {
                                        switch ($status) {
                                            case 'success':
                                                return '<span class="text-success">Thành công</span>';
                                            case 'fail':
                                                return '<span class="text-danger">Thất bại</span>';
                                    
                                            default:
                                                return '';
                                        }
                                    }
                                    ?>
                                    <table class="table table-striped account-activity-log-table" id=""
                                        role="grid" aria-describedby="table-info">
                                        <thead>
                                            <tr role="row">
                                                @foreach ($heads as $col)
                                                    <th class="" tabindex="0" aria-controls="" rowspan="1"
                                                        colspan="1">
                                                        {{ $col }}
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $index => $col)
                                                <tr role="row">
                                                    <td>
                                                        {{ $index }}
                                                    </td>
                                                    <td>
                                                        {{ $col->activity }}
                                                    </td>
                                                    <td>
                                                        {{ $col->type }}
                                                    </td>
                                                    <td>
                                                        {{ $col->ipAddress }}
                                                    </td>
                                                    <td>
                                                        {{ $col->time }}
                                                    </td>
                                                    <td>
                                                        {!! renderStatusClass($col->status) !!}
                                                    </td>
                                                </tr>
                                            @endforeach





                                        </tbody>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="card account-card">
                        <div class="card-header account-card-header">
                            <div class="account-card-header-left">
                                <h1 class="account-card-header-title">
                                    Hủy kích hoạt tài khoản
                                </h1>
                            </div>

                        </div>
                        <div class="card-body account-card-body">

                            <div class="form-check account-card-form-check-group ">
                                <input class="form-check-input account-card-form-check-input" type="checkbox"
                                    value="" id="">
                                <label class="form-check-label account-card-form-check-label" for="">
                                    Bạn có chắc chắn muốn hủy kích hoạt tài khoản của mình không
                                </label>
                            </div>

                            <div class="account-card-body-footer">
                                <button class="btn btn-danger account-card-form-submit-btn">
                                    Hủy kích hoạt tài khoản
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <x-utils.form-errors id="updateProfileFormError" :errors="$errors">

    </x-utils.form-errors>
@endsection
