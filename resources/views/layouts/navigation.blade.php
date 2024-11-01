@vite(['resources/sass/nav.scss','resources/js/nav.js'])
<nav x-data="{ open: false }" class="border-b border-gray-100 nav-bar">
    <!-- Primary Navigation Menu -->
    <div class="">
        <div class="flex justify-between h-16">
            <div class="flex">
                @php
                // Lấy segment cuối cùng của URL
                $currentSegment = request()->segment(count(request()->segments()));

                // Mảng chứa các segment và tiêu đề tương ứng
                $titles = [
                    'logs' => 'Hồ sơ',
                    'upgrade' => 'Nâng cấp',
                    'menu-bank' => 'Tổng quan',
                    'purchase' => 'Nạp sCoin',
                    'search' => 'Hồ sơ',
                    'sort' => 'Hồ sơ',
                    'momo-accounts' => "Tài khoản Momo",
                    'add' => "Thêm tài khoản"
                    // Thêm các segment khác nếu cần
                ];

                // Lấy tiêu đề dựa trên segment, nếu không có thì mặc định là segment hiện tại
                $pageTitle = $titles[$currentSegment] ?? ucfirst($currentSegment);
            @endphp
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard.logs.index')" :active="request()->routeIs('dashboard.logs.index')" class="task-bar">
                        {{ __('Trang chủ') }}
                    </x-nav-link>
                    <div class="arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </div>

                    <x-nav-link :href="url($currentSegment)" class="task-bar task-active">
                        {{ __($pageTitle) }}
                    </x-nav-link>
                </div>
            </div>
            <div class="nav-logout">
                <div class="avatar-profile avatar" id="avatar">
                    <!-- Đảm bảo có dấu '/' trước tên tệp -->
                    <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" style="border-radius: 100%; width: 32px; height: 32px; object-fit: cover;" alt="Avatar">
                </div>
                <div class="table-option" id="dropdownMenu" style="display: none;">
                    <div class="name">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="table">
                        <div class="option">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                            <p>Tài khoản</p>
                        </div>
                        <div class="option">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-lock" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1" />
                            </svg>
                            <p>Thay đổi mật khẩu</p>
                        </div>
                        <div class="option bottom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-question-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94" />
                            </svg>
                            <p>Hỗ trợ</p>
                        </div>
                    </div>
                    <div class="option" id="logoutButton">
                        <form id="logoutForm" class="table" style="border:none;" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="option" type="submit" style="background:none;border:none;color:white;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-toggle-off" viewBox="0 0 16 16">
                                    <path d="M11 4a4 4 0 0 1 0 8H8a5 5 0 0 0 2-4 5 5 0 0 0-2-4zm-6 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8M0 8a5 5 0 0 0 5 5h6a5 5 0 0 0 0-10H5a5 5 0 0 0-5 5" />
                                </svg>
                                <p>Đăng xuất</p>
                            </button>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard.logs.index')" :active="request()->routeIs('dashboard.logs.index')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
<script>
    const logoutUrl = "{{ route('logout') }}";
    const csrfToken = "{{ csrf_token() }}";
</script>