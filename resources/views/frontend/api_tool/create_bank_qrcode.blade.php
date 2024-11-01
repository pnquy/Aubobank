@extends('frontend.layouts.app')

@section('content')
    <div class="api-tool">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card api-tool-card">
                    <div class="card-header api-tool-card-header">
                        <div class="api-tool-card-header-left">
                            <h1 class="api-tool-card-header-title">
                                Hệ thống tạo QR code ngân hàng
                            </h1>
                        </div>
                        <div class="api-tool-card-header-right"></div>
                    </div>
                    <div class="card-body api-tool-card-body">
                        <?php
                        
                        $banks = [
                            (object) [
                                'id' => 'ICB',
                                'name' => 'VietinBank',
                            ],
                            (object) [
                                'id' => 'VCB',
                                'name' => 'Vietcombank',
                            ],
                            (object) [
                                'id' => 'BIDV',
                                'name' => 'BIDV',
                            ],
                            (object) [
                                'id' => 'VBA',
                                'name' => 'Agribank',
                            ],
                            (object) [
                                'id' => 'OCB',
                                'name' => 'OCB',
                            ],
                            (object) [
                                'id' => 'MB',
                                'name' => 'MBBank',
                            ],
                            (object) [
                                'id' => 'TCB',
                                'name' => 'Techcombank',
                            ],
                            (object) [
                                'id' => 'ACB',
                                'name' => 'ACB',
                            ],
                            (object) [
                                'id' => 'VPB',
                                'name' => 'VPBank',
                            ],
                            (object) [
                                'id' => 'TPB',
                                'name' => 'TPBank',
                            ],
                            (object) [
                                'id' => 'STB',
                                'name' => 'Sacombank',
                            ],
                            (object) [
                                'id' => 'HDB',
                                'name' => 'HDBank',
                            ],
                            (object) [
                                'id' => 'VCCB',
                                'name' => 'VietCapitalBank',
                            ],
                            (object) [
                                'id' => 'SCB',
                                'name' => 'SCB',
                            ],
                            (object) [
                                'id' => 'VIB',
                                'name' => 'VIB',
                            ],
                            (object) [
                                'id' => 'SHB',
                                'name' => 'SHB',
                            ],
                            (object) [
                                'id' => 'EIB',
                                'name' => 'Eximbank',
                            ],
                            (object) [
                                'id' => 'MSB',
                                'name' => 'MSB',
                            ],
                            (object) [
                                'id' => 'CAKE',
                                'name' => 'CAKE',
                            ],
                            (object) [
                                'id' => 'Ubank',
                                'name' => 'Ubank',
                            ],
                            (object) [
                                'id' => 'TIMO',
                                'name' => 'Timo',
                            ],
                            (object) [
                                'id' => 'VTLMONEY',
                                'name' => 'ViettelMoney',
                            ],
                            (object) [
                                'id' => 'VNPTMONEY',
                                'name' => 'VNPTMoney',
                            ],
                            (object) [
                                'id' => 'SGICB',
                                'name' => 'SaigonBank',
                            ],
                            (object) [
                                'id' => 'BAB',
                                'name' => 'BacABank',
                            ],
                            (object) [
                                'id' => 'PVCB',
                                'name' => 'PVcomBank',
                            ],
                            (object) [
                                'id' => 'Oceanbank',
                                'name' => 'Oceanbank',
                            ],
                            (object) [
                                'id' => 'NCB',
                                'name' => 'NCB',
                            ],
                            (object) [
                                'id' => 'SHBVN',
                                'name' => 'ShinhanBank',
                            ],
                            (object) [
                                'id' => 'ABB',
                                'name' => 'ABBANK',
                            ],
                            (object) [
                                'id' => 'VAB',
                                'name' => 'VietABank',
                            ],
                            (object) [
                                'id' => 'NAB',
                                'name' => 'NamABank',
                            ],
                            (object) [
                                'id' => 'PGB',
                                'name' => 'PGBank',
                            ],
                            (object) [
                                'id' => 'VIETBANK',
                                'name' => 'VietBank',
                            ],
                            (object) [
                                'id' => 'BVB',
                                'name' => 'BaoVietBank',
                            ],
                            (object) [
                                'id' => 'SEAB',
                                'name' => 'SeABank',
                            ],
                            (object) [
                                'id' => 'COOPBANK',
                                'name' => 'COOPBANK',
                            ],
                            (object) [
                                'id' => 'LPB',
                                'name' => 'LienVietPostBank',
                            ],
                            (object) [
                                'id' => 'KLB',
                                'name' => 'KienLongBank',
                            ],
                            (object) [
                                'id' => 'KBank',
                                'name' => 'KBank',
                            ],
                            (object) [
                                'id' => 'SCVN',
                                'name' => 'StandardChartered',
                            ],
                            (object) [
                                'id' => 'PBVN',
                                'name' => 'PublicBank',
                            ],
                            (object) [
                                'id' => 'IVB',
                                'name' => 'IndovinaBank',
                            ],
                            (object) [
                                'id' => 'IBK - HCM',
                                'name' => 'IBKHCM',
                            ],
                            (object) [
                                'id' => 'UOB',
                                'name' => 'UnitedOverseas',
                            ],
                            (object) [
                                'id' => 'IBK - HN',
                                'name' => 'IBKHN',
                            ],
                            (object) [
                                'id' => 'NHB HN',
                                'name' => 'Nonghyup',
                            ],
                            (object) [
                                'id' => 'HLBVN',
                                'name' => 'HongLeong',
                            ],
                            (object) [
                                'id' => 'GPB',
                                'name' => 'GPBank',
                            ],
                            (object) [
                                'id' => 'DOB',
                                'name' => 'DongABank',
                            ],
                            (object) [
                                'id' => 'VRB',
                                'name' => 'VRB',
                            ],
                            (object) [
                                'id' => 'WVN',
                                'name' => 'Woori',
                            ],
                            (object) [
                                'id' => 'KBHN',
                                'name' => 'KookminHN',
                            ],
                            (object) [
                                'id' => 'KBHCM',
                                'name' => 'KookminHCM',
                            ],
                            (object) [
                                'id' => 'DBS',
                                'name' => 'DBSBank',
                            ],
                            (object) [
                                'id' => 'CIMB',
                                'name' => 'CIMB',
                            ],
                            (object) [
                                'id' => 'CBB',
                                'name' => 'CBBank',
                            ],
                            (object) [
                                'id' => 'HSBC',
                                'name' => 'HSBC',
                            ],
                        ];
                        // Tạo một mảng trống
                        $frames = [
                            (object) [
                                'id' => '0',
                                'name' => 'Mặc định',
                            ],
                        ];
                        
                        // Tạo mảng với 16 phần tử
                        for ($index = 1; $index <= 16; $index++) {
                            // Tạo đối tượng với id và name tương ứng
                            $object = new stdClass();
                            $object->id = $index;
                            $object->name = "Khung $index";
                            $frames[] = $object;
                        }
                        
                        $inputs = [
                            (object) [
                                'type' => 'select',
                                'name' => 'bank',
                                'label' => 'Chọn ngân hàng',
                                'placeholder' => 'Chọn ngân hàng cần tạo',
                                'options' => $banks,
                            ],
                            (object) [
                                'type' => 'text',
                                'name' => 'accountNo',
                                'label' => 'Số tài khoản ngân hàng',
                                'placeholder' => 'Nhập số tài khoản ngân hàng',
                            ],
                            (object) [
                                'type' => 'text',
                                'name' => 'accountName',
                                'label' => 'Tên tài khoản',
                                'placeholder' => 'Nhập tên tiếng Việt không dấu',
                            ],
                        
                            (object) [
                                'type' => 'select',
                                'name' => 'bank',
                                'label' => 'Chọn số khung',
                                'placeholder' => 'Không hiển thị khung',
                                'options' => $frames,
                            ],
                        
                            (object) [
                                'type' => 'text',
                                'name' => 'amount',
                                'label' => 'Số tiền',
                                'placeholder' => 'Nhập số tiền',
                            ],
                        
                            (object) [
                                'type' => 'text',
                                'name' => 'content',
                                'label' => 'Nội dung',
                                'placeholder' => 'Nhập nội dung chuyển khoản',
                            ],
                        ];
                        ?>

                        <x-forms.post class="api-tool-card-form" action="" noValidate>
                            @foreach ($inputs as $input)
                                @if ($input->type === 'select')
                                    <div class="api-tool-card-form-group">
                                        <label for="{{ $input->name }}" class="api-tool-card-form-label">
                                            {{ $input->label }}</label>
                                        <select class="form-control api-tool-card-form-input">
                                            <option value="">
                                                {{ $input->placeholder }}
                                            </option>
                                            @foreach ($input->options as $option)
                                                <option value="{{ $option->id }}">
                                                    {{ $option->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="api-tool-card-form-group">
                                        <label for="{{ $input->name }}" class="api-tool-card-form-label">
                                            {{ $input->label }}
                                        </label>
                                        <input id="{{ $input->name }}" type="text" name="{{ $input->name }}"
                                            class="form-control api-tool-card-form-input"
                                            placeholder="{{ $input->placeholder }}" value="{{ old($input->name) }}" />
                                    </div>
                                @endif
                            @endforeach
                            <button class="btn btn-primary api-tool-card-form-submit-btn" type="button">Tạo QR
                                code</button>
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
                        <div class="create-bank-qrcode-right api-tool-card-form">

                            <div class="api-tool-card-form-group">
                                <div class="input-group api-tool-card-form-input-group">
                                    <input type="text" class="form-control api-tool-card-form-input" id="qrCodeContent"
                                        value="ac5cd0486af5faa1dca59621a53b0f85" disabled>
                                    <button class="btn btn-primary text-white api-tool-card-form-input-append-btn"
                                        id="copyQrCodeContentBtn">
                                        Copy
                                    </button>
                                </div>
                            </div>

                            <div class="create-bank-qrcode-wrapper">
                                <img class="create-bank-qrcode-img"transferContent
                                    src='https://img.vietqr.io/image/vietinbank-113366668888-compact.jpg' />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <x-toast.success id="successToast" title="" description="">

    </x-toast.success>


    @push('after-scripts')
        <script type="module">

        import { showSuccessToast } from "/js/frontend/global/components/toast.js"

        $("#copyQrCodeContentBtn").on('click', function() {
            const text = $('#qrCodeContent').val();
          // Tạo một phần tử textarea tạm thời để chứa nội dung văn bản
            const tempTextarea = document.createElement('textarea');
            tempTextarea.value = text;
            document.body.appendChild(tempTextarea);

            // Chọn toàn bộ nội dung trong phần tử textarea
            tempTextarea.select();
            tempTextarea.setSelectionRange(0, 99999); // Đối với một số trình duyệt di động

            // Copy nội dung vào clipboard
            document.execCommand('copy');

            // Xóa phần tử textarea tạm thời
            document.body.removeChild(tempTextarea);

            // Thông báo hoặc xử lý sau khi đã copy thành công
            console.log("Đã sao chép vào clipboard: ", text);
            showSuccessToast('successToast', {title: "Copy thành công", description: text})

        })
    </script>
    @endpush
@endsection
