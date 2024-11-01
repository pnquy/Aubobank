@extends('frontend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-9 col-12">
            <div class="card ecaptcha-card">
                <div class="card-header ecaptcha-card-header">
                    <div class="ecaptcha-card-header-left">
                        <h1 class="ecaptcha-card-header-title">
                            Access Key
                        </h1>
                    </div>
                    <div class="ecaptcha-card-header-right">
                        <span class="text-primary" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#ecaptchaAccessTokenOffcanvasRight">
                            (Access Key là gì?)
                        </span>
                    </div>

                    <div class="offcanvas offcanvas-end ecaptcha-access-token-offcanvas" tabindex="-1"
                        id="ecaptchaAccessTokenOffcanvasRight" aria-labelledby="offcanvasRightLabel" style="width: 500px;">
                        <div class="offcanvas-header ecaptcha-access-token-header">
                            <h2 id="offcanvasRightLabel" class="ecaptcha-access-token-title">Access Key</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                        </div>
                        <ul class="offcanvas-body ecaptcha-access-token-body">
                            <li class="ecaptcha-access-token-body-item">&#x25CF; Key dùng để xác thực sCoint cũng như
                                truy vấn
                                lịch su sCoint.</li>
                            <li class="ecaptcha-access-token-body-item">&#x25CF; Key dùng để truy cập tài khoản tại
                                Web2M từ
                                xa thông qua các API tài khoản.</li>
                            <li class="ecaptcha-access-token-body-item">&#x25CF; Access Key không phải là Token của
                                ngân hàng
                                và không thể thay thế token của ngân
                                hàng.</li>



                        </ul>
                    </div>

                </div>
                <div class="card-body ecaptcha-card-body">

                    <div class="ecaptcha-card-form-group">
                        <div class="input-group ecaptcha-card-form-input-group">
                            <input type="text" class="form-control ecaptcha-card-form-input"
                                value="ac5cd0486af5faa1dca59621a53b0f85" disabled>
                            <button class="btn btn-primary text-white ecaptcha-card-form-input-append-btn">
                                Đổi key
                            </button>
                        </div>
                    </div>


                </div>
            </div>

            <div class="card ecaptcha-card">
                <div class="card-header ecaptcha-card-header">
                    <div class="ecaptcha-card-header-left">
                        <h1 class="ecaptcha-card-header-title">
                            Tài liệu API
                        </h1>
                    </div>


                </div>
                <div class="card-body ecaptcha-card-body">
                    <?php
                    $demoCode = '
                                                                                                                        {
                                                                                                                            "name": "John Doe",
                                                                                                                            "age": 30,
                                                                                                                            "email": "johndoe@example.com",
                                                                                                                            "address": {
                                                                                                                            "street": "123 Street",
                                                                                                                            "city": "City",
                                                                                                                            "state": "State",
                                                                                                                            "country": "Country"
                                                                                                                            },
                                                                                                                            "interests": ["programming", "reading", "music"]
                                                                                                                        }';
                    
                    ?>

                    <div class="api-document-view-wrapper">
                        <pre><code class="pre api-document-view">{!! htmlspecialchars($demoCode) !!}</code></pre>
                    </div>


                </div>
            </div>

        </div>
    </div>
@endsection
