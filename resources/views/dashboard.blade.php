@include('layouts.menu')
@vite(['resources/sass/profile.scss','resources/js/form.js'])
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="profile">
    @include('layouts.navigation')
    <h1>Hồ sơ cá nhân</h1>
    <div class="main-profile">
        <div class="left1">
            <div class="top block">
                <div class="header">
                    <div class="avatar-profile">
                        <!-- Đảm bảo có dấu '/' trước tên tệp -->
                        <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="Avatar">
                    </div>
                    <div class="name">
                        <p>@php
                            echo Auth::user()->name;
                        @endphp</p>
                        <p>sPoint: sPoint</p>
                    </div>
                </div>
                <div class="menu">
                    <div class="nav" onclick="showProfileForm()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-activity" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2" />
                        </svg>
                        <p>Thông tin cá nhân</p>
                    </div>
                    <div class="nav" onclick="showResetPasswordForm()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1" />
                        </svg>
                        <p>Đổi mật khẩu</p>
                    </div>
                    <div class="nav">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                            <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z" />
                        </svg>
                        <p>Nạp tiền vào tài khoản</p>
                    </div>
                </div>
            </div>
            <div class="intro-y box mt-5 block">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Thông tin kích hoạt
                    </h2>
                </div>
                <div class="">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 xl:col-span-12">
                            <div class="des">
                                <label for="update-profile-form-6" class="form-label">Số dư tài khoản</label>
                                <input id="update-profile-form-6" type="text" class="form-control" placeholder="Input text" 
                                    value="{{ $bankingInfo->balance ?? '0 sCoin' }}" disabled>
                            </div>

                            <div class="mt-3 des">
                                <label for="update-profile-form-7" class="form-label">Thời hạn sử dụng gói 1</label>
                                <input id="update-profile-form-7-1" type="text" class="form-control" 
                                    value="{{ $bankingInfo->package_1 ?? 'Hết hạn' }}" disabled>
                            </div>

                            <div class="mt-3 des">
                                <label for="update-profile-form-7" class="form-label">Thời hạn sử dụng gói MoMo</label>
                                <input id="update-profile-form-7-2" type="text" class="form-control" 
                                    value="{{ $bankingInfo->package_momo ?? 'Hết hạn' }}" disabled>
                            </div>

                            <div class="mt-3 des">
                                <label for="update-profile-form-7" class="form-label">Thời hạn sử dụng Vietcombank</label>
                                <input id="update-profile-form-7-3" type="text" class="form-control" 
                                    value="{{ $bankingInfo->package_vcb ?? 'Hết hạn' }}" disabled>
                            </div>

                            <div class="mt-3 des">
                                <label for="update-profile-form-7" class="form-label">Thời hạn sử dụng BIDV</label>
                                <input id="update-profile-form-7-4" type="text" class="form-control" 
                                    value="{{ $bankingInfo->package_bidv ?? 'Hết hạn' }}" disabled>
                            </div>

                            <div class="mt-3 des">
                                <label for="update-profile-form-7" class="form-label">Thời hạn sử dụng MBBank</label>
                                <input id="update-profile-form-7-5" type="text" class="form-control" 
                                    value="{{ $bankingInfo->package_mb ?? 'Hết hạn' }}" disabled>
                            </div>

                            <div class="mt-3 des">
                                <label for="update-profile-form-7" class="form-label">Thời hạn sử dụng Techcombank</label>
                                <input id="update-profile-form-7-6" type="text" class="form-control" 
                                    value="{{ $bankingInfo->package_techcom ?? 'Hết hạn' }}" disabled>
                            </div>

                            <div class="mt-3 des">
                                <label for="update-profile-form-7" class="form-label">Thời hạn sử dụng ACB</label>
                                <input id="update-profile-form-7-7" type="text" class="form-control" 
                                    value="{{ $bankingInfo->package_acb ?? 'Hết hạn' }}" disabled>
                            </div>

                            <div class="mt-3 des">
                                <label for="update-profile-form-7" class="form-label">Thời hạn sử dụng API ZaloPay</label>
                                <input id="update-profile-form-7-8" type="text" class="form-control" 
                                    value="{{ $bankingInfo->package_zalopay ?? 'Hết hạn' }}" disabled>
                            </div>

                            <div class="mt-3 des">
                                <label for="update-profile-form-7" class="form-label">Thời hạn sử dụng API TPBank</label>
                                <input id="update-profile-form-7-9" type="text" class="form-control" 
                                    value="{{ $bankingInfo->package_tp ?? 'Hết hạn' }}" disabled>
                            </div>

                            <div class="mt-3 des">
                                <label for="update-profile-form-7" class="form-label">Thời hạn sử dụng API Thẻ siêu rẻ</label>
                                <input id="update-profile-form-7-10" type="text" class="form-control" 
                                    value="{{ $bankingInfo->package_tsr ?? 'Hết hạn' }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="right1">
            <div id="reset-password-form" class="block reset-password" style="display: none;">
                @include('profile.partials.update-password-form')
            </div>
            <div id="profile-form">
                <div class="block token">
                    <div class="header">
                        <p>Access Token</p>
                        <a href="#">(Access Token là gì?)</a>
                    </div>
                    <div class="take-token">
                        <input type="text" id="randomInput" readonly disabled>
                        <button id="generateButton">Đổi Key</button> 
                    </div>
                </div>
                <div class="block information">
                    <div class="left">
                        @if(isset($update_message))
                        <p>{{ $update_message }}</p>
                        @endif
                        @if(isset($user_error))
                        <p>{{ $user_error }}</p>
                        @endif
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            
                            <div class="form-group">
                                <label for="name">Họ và Tên:</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user['name'] ?? '') }}" disabled placeholder="{{ Auth::user()->name }}">
                            </div>

                            <div class="form-group">
                                <label for="phone">Số điện thoại:</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone', $user['phone'] ?? '') }}" disabled placeholder="{{ Auth::user()->phone }}">
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user['email'] ?? '') }}" disabled placeholder="{{ Auth::user()->email }}">
                            </div>

                            <div class="form-group">
                                <label for="organization">Tổ chức:</label>
                                <input type="text" id="organization" name="organization" value="{{ old('organization', $user['organization'] ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Địa chỉ:</label>
                                <input type="text" id="address" name="address" value="{{ old('address', $user['address'] ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="otp">Bật tắt tính năng OTP Xác thực đăng nhập:</label>
                                <select id="otp" name="otp">
                                    <option value="enabled" {{ (old('otp', $user['otp'] ?? '') == 'enabled') ? 'selected' : '' }}>Bật</option>
                                    <option value="disabled" {{ (old('otp', $user['otp'] ?? '') == 'disabled') ? 'selected' : '' }}>Tắt</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="anti-duplicate">Bật tắt tính năng chống chuyển trùng nội dung:</label>
                                <select id="anti-duplicate" name="anti_duplicate">
                                    <option value="enabled" {{ (old('anti_duplicate', $user['anti_duplicate'] ?? '') == 'enabled') ? 'selected' : '' }}>Bật</option>
                                    <option value="disabled" {{ (old('anti_duplicate', $user['anti_duplicate'] ?? '') == 'disabled') ? 'selected' : '' }}>Tắt</option>
                                </select>
                            </div>

                            <button type="submit">Cập nhật</button>
                        </form>
                    </div>
                    <div class="right">
                        <form id="avatarForm" method="POST" action="{{ route('profile.update-avatar') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="avatarInput" name="avatar" accept="image/*">
                            <button type="submit">Cập nhật ảnh đại diện</button>
                        </form>

                        <div class="right">
                            <div class="avatar-profile">
                                <!-- Đảm bảo có dấu '/' trước tên tệp -->
                                <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="Avatar">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block telegram">
                    <div class="header">
                        <p>Thiết lập nâng cao</p>
                    </div>
                    <div class="form-telegram">
                        <form action="{{ route('profile.update-telegram-settings') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="anti-duplicate-tele">Bật tắt tính năng thông báo Telegram</label>
                                <select id="anti-duplicate-tele" name="anti_duplicate">
                                    <option value="enabled" {{ (old('anti_duplicate', $user['anti_duplicate'] ?? '') == 'enabled') ? 'selected' : '' }}>Bật</option>
                                    <option value="disabled" {{ (old('anti_duplicate', $user['anti_duplicate'] ?? '') == 'disabled') ? 'selected' : '' }}>Tắt</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telegram-id">Telegram Group ID</label>
                                <input type="text" id="telegram-id" name="telegram_id" value="{{ old('telegram_id') }}">
                            </div>
                            <div class="form-group">
                                <label for="telegram-token">Telegram Token</label>
                                <input type="text" id="telegram-token" name="telegram_token" value="{{ old('telegram_token') }}">
                            </div>
                            <button type="submit">Lưu</button>
                        </form>
                    </div>
                </div>
                <div class="dashboard block diary">
                    <h1>Nhật ký hoạt động</h1>
                    
                    <!-- Search Box -->
                    <form method="GET" action="{{ route('dashboard.logs.search') }}">
                        <input type="text" name="query" placeholder="Tìm kiếm hành động hoặc IP..." value="{{ request()->input('query') }}">
                        <button type="submit">Tìm kiếm</button>
                    </form>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('dashboard.logs.sort', ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                        STT
                                        @if(request('sort') === 'id')
                                            @if(request('direction') === 'asc')
                                                ↑
                                            @else
                                                ↓
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('dashboard.logs.sort', ['sort' => 'action', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                        Hành động
                                        @if(request('sort') === 'action')
                                            @if(request('direction') === 'asc')
                                                ↑
                                            @else
                                                ↓
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('dashboard.logs.sort', ['sort' => 'type', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                        Loại
                                        @if(request('sort') === 'type')
                                            @if(request('direction') === 'asc')
                                                ↑
                                            @else
                                                ↓
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('dashboard.logs.sort', ['sort' => 'ip_address', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                        IP Address
                                        @if(request('sort') === 'ip_address')
                                            @if(request('direction') === 'asc')
                                                ↑
                                            @else
                                                ↓
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('dashboard.logs.sort', ['sort' => 'timestamp', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                        Thời gian
                                        @if(request('sort') === 'timestamp')
                                            @if(request('direction') === 'asc')
                                                ↑
                                            @else
                                                ↓
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('dashboard.logs.sort', ['sort' => 'status', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                        Trạng thái
                                        @if(request('sort') === 'status')
                                            @if(request('direction') === 'asc')
                                                ↑
                                            @else
                                                ↓
                                            @endif
                                        @endif
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $index => $log)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $log->action }}</td>
                                    <td>{{ $log->type }}</td>
                                    <td>{{ $log->ip_address }}</td>
                                    <td>{{ $log->timestamp }}</td>
                                    <td>{{ $log->status }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $logs->links() }}
                    </div>
                </div>

                <div class="block drop-account">
                    <div class="header">
                        Huỷ kích hoạt tài khoản
                    </div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Vite JS -->
@vite('resources/js/app.js')
@vite('resources/js/profile.js')
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-dz16cu5KtmCwLckpt3HX0lZT1L2JKoPflFZtZH5FvATnRjv9b1JmJ6S1f2cm9Dxu" crossorigin="anonymous"></script>

</body>

</html>
