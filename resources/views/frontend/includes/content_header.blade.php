<div class="content-header">
    <div>
        @include('frontend.includes.partials.breadcrumbs')
    </div>

    <div class="content-header-right">
        <div class="content-header-notify-wrapper">
            <i class="far fa-bell content-header-notify-icon" id="toggleContentHeaderNotify">
                <span class="content-header-notify-new-notify-badge"></span>
            </i>
            <div class="content-header-notify-menu" id="contentHeaderNotify">
                <ul class="content-header-notify-menu-list">
                    <li class="content-header-notify-menu-item">
                        Thông báo 1
                    </li>
                    <li class="content-header-notify-menu-item">
                        Thông báo 2
                    </li>
                    <li class="content-header-notify-menu-item">
                        Thông báo 3
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-header-user-menu-wrapper">
            <img class="content-header-user-avatar" id="toggleContentHeaderMenu"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRY5AsGV-I02FwBi5MBTpcDAMgcLNd5c-qA3A&usqp=CAU"
                style="width: 20px; height: 20px" />
            <div class="content-header-user-menu" id="contentHeaderMenu">
                <div class="content-header-user-menu-title">
                    {{ $user->name }}
                </div>
                <ul class="content-header-user-menu-list">
                    <li class="content-header-user-menu-item">
                        <a href="{{ route('frontend.user.index') }}" class="content-header-user-menu-link">
                            <i class="fa-solid fa-user content-header-user-menu-icon"></i>
                            Tài khoản
                        </a>
                    </li>
                    <li class="content-header-user-menu-item">
                        <a href="" class="content-header-user-menu-link">
                            <i class="fa-solid fa-lock content-header-user-menu-icon"></i>
                            Thay đổi mật khẩu
                        </a>
                    </li>
                    <li class="content-header-user-menu-item">
                        <a href="" class="content-header-user-menu-link">
                            <i class="fa-solid fa-question content-header-user-menu-icon"></i>
                            Hỗ trợ
                        </a>
                    </li>
                    <div class="content-header-user-menu-devider"></div>
                    <li class="content-header-user-menu-item">
                        <a href="" class="content-header-user-menu-link"
                            onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                            <i class="fa-solid fa-right-from-bracket content-header-user-menu-icon"></i>
                            Đăng xuất
                        </a>
                        <x-forms.post id="logoutForm" action="{{ route('frontend.auth.logout') }}" noValidate
                            style="display: none;">
                        </x-forms.post>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
