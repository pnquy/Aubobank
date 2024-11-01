@extends('frontend.layouts.app')



@section('content')
    <div class="account">
        <div class="account-header">
            <h1 class="account-title">
                Hồ sơ cá nhân
            </h1>
        </div>
        <div class="account-content">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-12">
                    @include('frontend.user.includes.account_card_menu')

                </div>

                <div class="col-xl-6 col-lg-8 col-12">
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
                            <?php
                            $inputs = [
                                (object) [
                                    'name' => 'currentPassword',
                                    'label' => 'Mật khẩu hiện tại',
                                    'placeholder' => 'Nhập lại mật khẩu hiện tại',
                                ],
                                (object) [
                                    'name' => 'password',
                                    'label' => 'Mật khẩu mới',
                                    'placeholder' => 'Nhập lại mật khẩu mới',
                                ],
                                (object) [
                                    'name' => 'confirmPassword',
                                    'label' => 'Nhập lại mật khẩu mới',
                                    'placeholder' => 'Nhập lại mật khẩu mới',
                                ],
                            ];
                            ?>

                            <x-forms.post class="change-password-form" action="{{ route('frontend.user.change_password') }}"
                                noValidate>
                                @foreach ($inputs as $input)
                                    <div class="change-password-form-input-group">
                                        <label for="{{ $input->name }}" class="change-password-form-input-label">
                                            {{ $input->label }}
                                        </label>
                                        <input id="{{ $input->name }}" type="password" name="{{ $input->name }}"
                                            class="form-control change-password-form-input"
                                            placeholder="{{ $input->placeholder }}" value="{{ old($input->name) }}" />
                                    </div>
                                @endforeach
                                <button class="btn btn-primary change-password-form-submit-btn">Đổi mật khẩu</button>
                            </x-forms.post>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-utils.form-errors id="changePasswordFormError" :errors="$errors">

    </x-utils.form-errors>
@endsection
