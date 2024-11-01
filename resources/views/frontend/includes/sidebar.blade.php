<div id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <a href="/" class="sidebar-brand">
            <img class="sidebar-header-img" src="{{ asset('img/brand/logo.png') }}" />
            <h1 class="sidebar-header-heading">Auto bank</h1>
        </a>
        <i class="fa-solid fa-bars sidebar-toggle-icon" id="sidebarToggle"></i>
    </div>

    <div class="sidebar-devider"></div>

    <div id="sidebarContent" class="sidebar-content">



        <ul class="sidebar-menu">
            @foreach ($menu as $item)
                @php
                    $isActive = isset($item['link']) && $item['link'] == Request::url();
                    $sidebarMenuClass = $isActive ? 'sidebar-menu-item active' : 'sidebar-menu-item';
                @endphp

                <li class="{{ $sidebarMenuClass }}">
                    <a href="{{ isset($item['link']) ? $item['link'] : 'javascript:;' }}" class="sidebar-menu-link">
                        <div class="sidebar-menu-icon">
                            {{-- <img src="{{ asset($item['leftIcon']) }}" alt="{{ $item['title'] }}"> --}}
                            {{-- <object data="{{ asset($item['leftIcon']) }}" type="image/svg+xml"></object> --}}

                            {!! $item['leftIcon'] !!}
                        </div>
                        <div class="sidebar-menu-title">
                            {{ $item['title'] }}
                            @if (isset($item['sub']) && is_array($item['sub']))
                                <div class="sidebar-menu-has-sub-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-chevron-down">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </div>
                            @endif

                        </div>

                    </a>

                    @if (isset($item['sub']) && is_array($item['sub']))
                        <ul class="sidebar-menu__sub">
                            @foreach ($item['sub'] as $subItem)
                                <li class="sidebar-menu-item">
                                    @if (isset($subItem['link']) && $subItem['link'])
                                        <a href="{{ $subItem['link'] }}" class="sidebar-menu-link">
                                            <div class="sidebar-menu-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-more-horizontal">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="19" cy="12" r="1"></circle>
                                                    <circle cx="5" cy="12" r="1"></circle>
                                                </svg>
                                            </div>
                                            <div class="sidebar-menu-title">
                                                {{ $subItem['title'] }}
                                            </div>
                                        </a>
                                    @endif

                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach

            <a class="sidebar-deposit-scoint-btn" href="{{ route('frontend.scoint.deposit_view') }}">
                Nạp scoint
            </a>
        </ul>




        <div class="sidebar-devider"></div>

        <h3 class="sidebar-info">
            Producted by <br /><span class="sidebar-info-company">Metech Software</span> -v1.0.0
        </h3>

    </div>







</div>
