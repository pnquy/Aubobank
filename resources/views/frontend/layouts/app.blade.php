<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} @yield('title')</title>
    <link rel="icon" href="{{ asset('/img/brand/logo.png') }}" type="image/x-icon">
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Tran Sang')">
    @yield('meta')

    @stack('before-styles')
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    @stack('after-styles')
</head>

<body>

    <div id="app" class="layout">
        @include('frontend.includes.sidebar')
        <main class="content">
            @include('frontend.includes.content_header')
            <div class="content-main">
                @yield('content')
            </div>
            <div class="chat-badge" id="toggleChatScreen">
                <i class="fa-brands fa-facebook-messenger chat-badge-icon"></i>

                <div class="chat-screen-wrapper" id="chatScreen">
                    <div class="chat-screen">
                        <div class="chat-screen-header">
                            <div class="chat-screen-header-title">
                                Chat với Admin
                            </div>
                        </div>
                        <div class="chat-screen-form">
                            <div class="chat-screen-input-wrapper">
                                <div class="chat-screen-input">
                                    Chat
                                </div>
                                <i class="fa-solid fa-paper-plane chat-screen-send-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!--app-->

    {{-- Modal --}}
    <x-info-modal.danger id="layoutErrorNotify" title="Thông báo" description="">
    </x-info-modal.danger>

    <x-info-modal.success id="layoutSuccessNotify" title="Thông báo" description="">
    </x-info-modal.success>



    @stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    {{-- <script  src="/js/frontend/global/components/modal.js">    </script> --}}
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
    <script type="module" src="{{ mix('js/frontend/upgradeAccount.js') }}">
    </script>

    @stack('after-scripts')
</body>

</html>
