<?php
$menu = [
    (object) [
        'label' => 'Nạp tiền',
        'route' => route('frontend.scoint.deposit_view'),
        'iconClass' => 'fa-solid fa-user',
    ],
    (object) [
        'label' => 'Chuyển tiền',
        'route' => route('frontend.scoint.transfer_view'),
        'iconClass' => 'fa-solid fa-lock',
    ],
    (object) [
        'label' => 'Lịch sử',
        'route' => route('frontend.scoint.history_view'),
        'iconClass' => 'fa-solid fa-dollar-sign',
    ],
];
?>


<div class="scoint-section">
    <ul class="nav nav-tabs scoint-tabs">
        @foreach ($menu as $item)
            <li class="nav-item scoint-tab-item">
                <a class="nav-link scoint-tab-link {{ request()->url() === $item->route ? 'scoint-tab-link-active' : '' }}"
                    href="{{ $item->route }}">
                    {{ $item->label }}</a>
            </li>
        @endforeach

    </ul>


    <div class="scoint-intro">
        <div class="text-primary scoint-intro-item">Tỷ giá 1VND = 1scoint</div>
        <div class="text-danger scoint-intro-item">Sau khi nạp tiền vui lòng refresh lại trang để xem tiền đà vào chưa
            trước
            khi nạp lệnh mới</div>
    </div>
</div>
