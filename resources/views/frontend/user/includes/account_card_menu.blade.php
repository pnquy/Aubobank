<div class="card account-card account-card-menu">
    <div class="card-header account-card-header account-card-menu-header">
        <div class="account-card-menu-header-img-wrapper">
            <img class="account-card-menu-header-img"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRY5AsGV-I02FwBi5MBTpcDAMgcLNd5c-qA3A&usqp=CAU"
                alt="User" />
        </div>
        <div class="account-card-menu-info">
            <div class="account-card-menu-info-description">Trần Ngọc sang</div>
            <div class="account-card-menu-info-description">sPoint: {{ $user->scoint }}</div>
            <div class="account-card-menu-info-description">sCoint: {{ $user->scoint }}</div>
        </div>
    </div>
    <div class="card-body account-card-body account-card-menu-body">
        <?php
        $menu = [
            (object) [
                'label' => 'Thông tin cá nhân',
                'route' => route('frontend.user.index'),
                'iconClass' => 'fa-solid fa-user',
            ],
            (object) [
                'label' => 'Đổi mật khẩu',
                'route' => route('frontend.user.change_password'),
                'iconClass' => 'fa-solid fa-lock',
            ],
            (object) [
                'label' => 'Nạp tiền vào tài khoản',
                'route' => route('frontend.scoint.deposit_view'),
                'iconClass' => 'fa-solid fa-dollar-sign',
            ],
        ];
        ?>
        @foreach ($menu as $item)
            <a href="{{ $item->route }}"
                class="account-card-menu-body-link {{ request()->url() === $item->route ? 'text-primary' : '' }}">
                <i class="{{ $item->iconClass }} account-card-menu-body-link-icon"></i>
                {{ $item->label }}
            </a>
        @endforeach
        {{-- <a href="{{ route('frontend.user.index') }}" class="account-card-menu-body-link text-primary">
            <i class="fa-solid fa-user account-card-menu-body-link-icon"></i>
            Thông tin cá nhân
        </a>
        <a href="{{ route('frontend.user.change_password') }}" class="account-card-menu-body-link">
            <i class="fa-solid fa-lock account-card-menu-body-link-icon"></i>
            Đổi mật khẩu</a>
        <a href="{{ route('frontend.user.index') }}" class="account-card-menu-body-link">
            <i class="fa-solid fa-dollar-sign account-card-menu-body-link-icon"></i>
            Nạp tiền vào tài khoản</a> --}}
    </div>
</div>
