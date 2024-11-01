<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Tran Sang')">
    @yield('meta')

    @stack('before-styles')
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    @stack('after-styles')
</head>

<body>

    <div id="auth" class="row auth-layout">
        <div class="col-lg-6 col-12 left">
            <div class="left-header">
                <a href="/" class="left-header-brand">
                    <img class="left-header-brand-img" src="{{ '/img/brand/logo.png' }}" />
                    <h1 class="left-header-brand-heading">Auto bank</h1>
                </a>
            </div>
            <div class="left-content">
                <img class="left-content-img" src="{{ '/img/auth/cover.png' }}" />
                <div class="left-content-description">
                    Auto Bank cung cấp hệ thống API xác nhận thanh toán tự động cho các cổng thanh toán trực tuyến phổ
                    biến như Momo, Vietcombank, Techcombank, MB Bank, ACB,...
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 right">
            <div class="auth-form-wrapper">
                <h1 class="auth-form-title">
                    {{ $title }}
                </h1>
                <x-forms.post class="auth-form" action="{{ $actionRoute }}" noValidate>
                    @yield('content')


                    <button class="btn btn-primary auth-form-submit-btn">
                        {{ $submitBtnLabel }}
                    </button>
                </x-forms.post>

                @if (isset($redirectQuestion) && isset($redirectLabel))
                    <div class="auth-form-redirect">
                        <span class="auth-form-redirect-question">
                            {{ $redirectQuestion }}
                        </span>
                        <a class="auth-form-redirect-link" href="{{ $redirectLink }}">
                            {{ $redirectLabel }}
                        </a>
                    </div>
                @endif

                @if (isset($backLabel))
                    <div class="auth-form-back">
                        <a class="auth-form-back-link" href="{{ route('frontend.auth.login') }}">
                            {{ $backLabel }}
                        </a>
                    </div>
                @endif


            </div>
        </div>

    </div>
    <!--app-->


    <x-utils.form-errors id="authFormError" :errors="$errors">

    </x-utils.form-errors>


    {{-- Modal --}}
    <x-info-modal.danger id="layoutErrorNotify" title="Thông báo" description="">
    </x-info-modal.danger>

    <x-info-modal.success id="layoutSuccessNotify" title="Thông báo" description="">
    </x-info-modal.success>



    @stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/frontend/app.js') }}"></script>
    <script type="module">
        import { showInfoModal } from "/js/frontend/global/components/modal.js";
        $(document).ready(function() {  
 
            if ("{{ Session::has('layoutErrorNotify') }}") {
                const description = "{{ Session::get('layoutErrorNotify') }}";
                console.log("description: ", description)
                showInfoModal(
                    "layoutErrorNotify",
                    {
                        title: "Lỗi",
                        description,
                    },
                );
            }
            if ("{{ Session::has('layoutSuccessNotify') }}") {
                const description = "{{ Session::get('layoutSuccessNotify') }}";
                console.log("description: ", description)
                showInfoModal(
                    "layoutSuccessNotify",
                    {
                        title: "Thông báo",
                        description,
                    },
                );
            }

        })

    </script>
    @stack('after-scripts')
</body>

</html>
