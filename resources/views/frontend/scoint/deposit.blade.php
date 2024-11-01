@extends('frontend.layouts.app')

@section('content')
    <div class="scoint-desposit">
        @include('frontend.scoint.includes.scoint_tabs')

        <div class="scoint-section">
            <div class="tab-content scoint-tab-content">
                <div class="tab-pane fade show active scoint-tab-desposit">

                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="bank">
                                <h1 class="scoint-tab-desposit-title">Nạp qua ngân hàng</h1>
                                <div class="bank-info">
                                    <?php
                                    $accountInfo = [
                                        (object) [
                                            'label' => 'Số tài khoản',
                                            'content' => '22784887799',
                                            'active' => true,
                                        ],
                                        (object) [
                                            'label' => 'Tên tài khoản',
                                            'content' => 'Nguyen ThanhDung',
                                            'active' => false,
                                        ],
                                        (object) [
                                            'label' => 'Ngân hàng',
                                            'content' => 'MB Bank',
                                            'active' => false,
                                        ],
                                        (object) [
                                            'label' => 'Chi Nhánh',
                                            'content' => 'Bình Thạnh TPHCM',
                                            'active' => false,
                                        ],
                                    ];
                                    ?>
                                    <div class="row">
                                        @foreach ($accountInfo as $info)
                                            <div class="col-4 bank-info-label">{{ $info->label }}</div>


                                            <div
                                                class="col-8 bank-info-content{{ $info->active === true ? ' bank-info-content-active' : '' }}">
                                                {{ $info->content }}</div>
                                        @endforeach
                                    </div>

                                    <div class="bank-transfer-content">
                                        <div class="bank-transfer-content-title">Nội dung chuyển khoản</div>
                                        <div class="bank-transfer-content-message" id="transferContent">3613812245</div>
                                        <button class="bank-transfer-content-copy-btn copyTransferContentBtn"
                                            type="button">Copy</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="qr-code">
                                <h1 class="scoint-tab-desposit-title">Quét Mã Qr Để Nạp Tiền Nhanh Hơn</h1>
                                <div class="qr-code-wrapper">
                                    <img src="https://img.vietqr.io/image/970422-22784887799-3aKLjdy.jpg?accountName=Nguyen Thanh Dung&amp;addInfo=3613812245"
                                        class="qr-code-img">
                                </div>
                            </div>
                        </div>
                    </div>


                    <h3>
                        <x-forms.post action="{{ route('frontend.scoint.deposit') }}" noValidate>
                            <button class="btn payment-gateway-table-action-btn">
                                <i class="fas fa-envelope  payment-gateway-table-action-btn-icon"></i>
                                Nạp coint
                            </button>
                        </x-forms.post>

                    </h3>
                    <!-- Nội dung của tab 1 -->
                </div>
            </div>

        </div>

        <div class="scoint-section">

            <div class="alert alert-danger text-danger scoint-alert-danger">
                <span>Chú ý:</span><br />
                - Nạp sai cú pháp hoặc sai số tài khoản sẽ bị trừ 10% phí giao dịch, tối đa trừ 50.000 mCoin. Ví dụ nạp sai
                100.000 trừ 10.000, 200.000 trừ 20.000, 500.000 trừ 50.000, 1 triệu trừ 50.000, 10 triệu trừ 50.000...
            </div>
            <div class="scoint-desposit-helper">
                <div class="scoint-desposit-helpr-title">Nội dung chuyển khoản</div>
                <div class="scoint-desposit-helper-bank-transfer-content">
                    <div class="scoint-desposit-helper-bank-transfer-content-message">3613812245</div>
                    <button
                        class="btn btn-primary scoint-desposit-helper-bank-transfer-content-copy-btn copyTransferContentBtn"
                        type="button">Copy</button>
                </div>
            </div>
        </div>


        <x-toast.success id="successToast" title="" description="">

        </x-toast.success>


        @push('after-scripts')
            <script type="module">

        import { showSuccessToast } from "/js/frontend/global/components/toast.js"

        $(".copyTransferContentBtn").on('click', function() {
            const text = $('#transferContent').text();
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
