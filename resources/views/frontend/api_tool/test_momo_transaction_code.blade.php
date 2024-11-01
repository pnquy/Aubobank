@extends('frontend.layouts.app')

@section('content')
    <div class="api-tool">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card api-tool-card">
                    <div class="card-header api-tool-card-header">
                        <div class="api-tool-card-header-left">
                            <h1 class="api-tool-card-header-title">
                                Kiểm tra lịch sử giao dịch Momo
                            </h1>
                        </div>
                        <div class="api-tool-card-header-right"></div>
                    </div>
                    <div class="card-body api-tool-card-body">
                        <?php
                        $inputs = [
                            (object) [
                                'name' => 'transactionCode',
                                'label' => 'Mã giao dịch',
                                'placeholder' => 'Nhập mã giao dịch',
                            ],
                            (object) [
                                'name' => 'token',
                                'label' => 'Token',
                                'placeholder' => 'Nhập token momo',
                            ],
                        ];
                        ?>

                        <x-forms.post class="api-tool-card-form" action="" noValidate>
                            @foreach ($inputs as $input)
                                <div class="api-tool-card-form-group">
                                    <label for="{{ $input->name }}" class="api-tool-card-form-label">
                                        {{ $input->label }}
                                    </label>
                                    <input id="{{ $input->name }}" type="text" name="{{ $input->name }}"
                                        class="form-control api-tool-card-form-input"
                                        placeholder="{{ $input->placeholder }}" value="{{ old($input->name) }}" />
                                </div>
                            @endforeach
                            <button class="btn btn-primary api-tool-card-form-submit-btn">Kiểm tra</button>
                        </x-forms.post>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="card api-tool-card">
                    <div class="card-header api-tool-card-header">
                        <div class="api-tool-card-header-left">
                            <h1 class="api-tool-card-header-title">
                                Kết quả
                            </h1>
                        </div>
                        <div class="api-tool-card-header-right"></div>
                    </div>
                    <div class="card-body api-tool-card-body">

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
