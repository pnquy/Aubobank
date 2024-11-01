@php
    use App\Models\PaymentGateway;
    
    function renderPaymentStatus($status)
    {
        $formattedStatus = ucfirst($status);
    
        switch ($status) {
            case PaymentGateway::STATUSES['READY']:
                $statusClass = 'bg-success text-white';
                $formattedStatus = ucfirst('Ổn định');
    
                break;
    
            case PaymentGateway::STATUSES['MAINTENANCE']:
                $statusClass = 'bg-warning text-white';
                $formattedStatus = ucfirst('Bảo trì');
    
                break;
    
            case PaymentGateway::STATUSES['COMMING_SOON']:
                $statusClass = 'bg-info text-white';
                $formattedStatus = ucfirst('Sắp ra mắt');
    
                break;
    
            default:
                $statusClass = '';
                break;
        }
    
        return '<div class="dashboard-report-item-status ' . $statusClass . '">' . $formattedStatus . '</div>';
    }
    
@endphp

@extends('frontend.layouts.app')


@section('content')
    <div class="row dashboard">
        <div class="col-12 col-lg-8 col-xl-9 dashboard-left">
            <x-utils.alert type="success" ariaLabel="{{ __('Thông báo') }}">
                {{ __('Số sCoint còn lại: 0 sCoint.') }}
            </x-utils.alert>
            <x-utils.alert type="success" ariaLabel="{{ __('Thông báo') }}">
                {{ __('sCoint là đơn vị tiền tệ của Web2M, dùng để thanh toán trên hệ thống API WEB2M. Tỉ lệ quy đổi: 1000 sCoint <=> 1000 VNĐ.') }}
            </x-utils.alert>

            <div class="dashboard-report">
                <div class="dashboard-report-top">
                    <h2 class="dashboard-report-title">
                        Thống kê tài khoản
                    </h2>
                    <a class="dashboard-report-reload" href="/">
                        <i class="fa-solid fa-repeat"></i>
                        Tải lại trang
                    </a>
                </div>
                <div class="containter p-2">
                    <div class="row dashboard-report-list">
                        @foreach ($paymentGateways as $paymentGateway)
                            <div class="col-12 col-lg-6 col-xl-3 p-3">
                                <a class="dashboard-report-item"
                                    href="{{ route('frontend.payment_gateway.index', ['paymentGateway' => $paymentGateway['brand']]) }}">
                                    <div class="dashboard-report-item-top">
                                        <img class="dashboard-report-item-img" src="{{ $paymentGateway['logo'] }}">
                                        {!! renderPaymentStatus($paymentGateway['status']) !!}

                                    </div>
                                    <div class="dashboard-report-item-count">{{ $paymentGateway['count'] }}</div>
                                    <div class="dashboard-report-item-name">{{ strtoupper($paymentGateway['brand']) }}</div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>

            <div class="dashboard-gateway">
                <h2 class="dashboard-gateway-title">
                    Chọn 1 cổng thanh toán để liên kết:
                </h2>
                <div class="row dashboard-gateway-list">
                    @foreach ($paymentGateways as $paymentGateway)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-2 p-3">
                            {{-- <a class="dashboard-gateway-item" href="/payment-gateways/momo/add"> --}}
                            <a class="dashboard-gateway-item" {{-- href="{{ route('frontend.payment_gateway.{brand}.index', ['brand' => 'momo']) }}"> --}} {{-- href="{{ route('frontend.payment_gateway.add', ['paymentGateway' => $paymentGateway]) }}"> --}}
                                href="{{ route('frontend.payment_gateway.add', ['paymentGateway' => $paymentGateway['brand']]) }}">


                                <img class="dashboard-gateway-item-img" src="{{ $paymentGateway['logo'] }}">
                                <div class="dashboard-gateway-item-name">{{ strtoupper($paymentGateway['brand']) }}</div>
                                <div class="dashboard-gateway-item-type">Cá nhân</div>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        <div class="col-12 col-lg-4 col-xl-3 dashboard-right">
            <div class="dashboard-right-top">
                <div class="dashboard-right-title">
                    Thông báo quan trọng
                </div>
                <div class="change-notify-btn-group">
                    <button class="change-notify-btn change-notify-prev"><i
                            class="fas fa-chevron-left change-notify-icon"></i></button>
                    <button class="change-notify-btn change-notify-next"><i
                            class="fas fa-chevron-right change-notify-icon"></i></button>
                </div>

            </div>
            <div class="dashboard-right-content">
                <div class="notify-list">
                    <div class="notify-card" style="display: none;">
                        <div class="notify-card-title">
                            Ra mắt công cụ kiểm thử API 1
                        </div>
                        <div class="notify-card-date-ago">
                            11 tháng trước
                        </div>
                        <div class="notify-card-description">
                            Ra mắt công cụ kiểm thử API
                        </div>
                    </div>
                    <div class="notify-card" style="display: none;">
                        <div class="notify-card-title">
                            Ra mắt công cụ kiểm thử API 2
                        </div>
                        <div class="notify-card-date-ago">
                            11 tháng trước
                        </div>
                        <div class="notify-card-description">
                            Ra mắt công cụ kiểm thử API
                        </div>
                    </div>
                </div>

                <div class="notify-card">
                    <div class="notify-card-title">
                        Thời gian hỗ trợ kỹ thuật - giải đáp
                    </div>
                    <div class="notify-card-description">
                        Từ 9:00 - 19:00 Thứ 2 - Thứ 7. (Không tính lễ -tết)
                    </div>
                    <ul class="notify-card-description-list">
                        <li class="notify-card-description-item">Whatsapp hỗ trợ: Chat Whatsapp</li>
                        <li class="notify-card-description-item">Zalo hỗ trợ: Chat Zalo</li>
                        <li class="notify-card-description-item">Nhóm Zalo: Nhóm Zalo</li>
                    </ul>
                </div>

                <div class="notify-card">
                    <div class="notify-card-title">
                        Chương trình khuyến mãi
                    </div>
                    <div class="notify-card-description mt-5">
                        <a class="notify-card-link"
                            href="https://web2m.com/khuyen-mai-den-90-web-hosting-cloud-vps-business-email-ky-niem-ngay-giai-phong-mien-nam-30-04-va-ngay-quoc-te-lao-dong-01-05/">
                            <img class="notify-card-img"
                                src="https://web2m.com/wp-content/uploads/2023/04/khuyen-mai-30.4.jpg" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
