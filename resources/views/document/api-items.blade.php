@vite(['resources/sass/profile.scss','resources/js/apidata.js','resources/sass/apidata.scss'])
{{-- Momo --}}
<div class="box">
    <div class="API-items">
        <h1 class="api-title" data-api="momo">Tài liệu API MoMo</h1>
        <div class="api-content">
            <h2 class="api-subtitle">URL API</h2>
            <div class="api-url">
                <span class="url-part url-base">https://</span>
                <span class="url-part url-path">api.web2m.com/historyapimomo/token</span>
            </div>

            <table class="api-table">
                <tr>
                    <th>Tham số</th>
                    <th>Dữ liệu</th>
                    <th>Ví dụ</th>
                    <th>Chú thích</th>
                </tr>
                <tr>
                    <td>Token</td>
                    <td>string</td>
                    <td>39D6670A-1B9A-A12B-ADB0-DB020B35F5CF</td>
                    <td>Token của tài khoản momo cần GET</td>
                </tr>
            </table>
            <div class="api-response">
                <h2 class="api-subtitle">Response</h2>
                <pre class="json-display"></pre>
            </div>
        </div>
    </div>
</div>

<!-- Viettinbank -->
<div class="box">
    <div class="API-items">
        <h1 class="api-title" data-api="viettinbank">Tài liệu API Viettinbank</h1>
        <div class="api-content">
            <h2 class="api-subtitle">URL API</h2>
            <div class="api-url">
                <p class="api-url-base">https:</p>
                <p class="api-url-path">//api.web2m.com/historyapivtb/password/sotaikhoan/token</p>
            </div>
            <table class="api-table">
                <tr>
                    <th>Tham số</th>
                    <th>Dữ liệu</th>
                    <th>Ví dụ</th>
                    <th>Chú thích</th>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>string</td>
                    <td>ABC123456</td>
                    <td>Mật khẩu sử dụng Internet Banking tương ứng với tài khoản đã add</td>
                </tr>
                <tr>
                    <td>sotaikhoan</td>
                    <td>string</td>
                    <td>123456789123</td>
                    <td>Số tài khoản Viettinbank</td>
                </tr>
                <tr>
                    <td>Token</td>
                    <td>string</td>
                    <td>39D6670A-1B9A-A12B-ADB0-DB020B35F5CF</td>
                    <td>Token của tài khoản Viettinbank cần GET</td>
                </tr>
            </table>
            <div class="api-response">
                <h2 class="api-subtitle">Response</h2>
                <pre class="json-display"></pre>
            </div>
        </div>
    </div>
</div>
{{-- BIDV --}}
<div class="box">
    <div class="API-items">
        <h1 class="api-title">Tài liệu API BIDV</h1>

        <div class="api-content">
            <h2 class="api-subtitle">URL API</h2>
            <div class="api-url">
                <p class="api-url-base">https:</p>
                <p class="api-url-path">//api.web2m.com/historyapivtb/password/sotaikhoan/token</p>
            </div>

            <table class="api-table">
                <tr>
                    <th>Tham số</th>
                    <th>Dữ liệu</th>
                    <th>Ví dụ</th>
                    <th>Chú thích</th>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>string</td>
                    <td>ABC123456</td>
                    <td>Mật khẩu sử dụng Internet Banking tương ứng với tài khoản đã add</td>
                </tr>
                <tr>
                    <td>sotaikhoan</td>
                    <td>string</td>
                    <td>123456789123</td>
                    <td>Số tài khoản BIDV</td>
                </tr>
                <tr>
                    <td>Token</td>
                    <td>string</td>
                    <td>39D6670A-1B9A-A12B-ADB0-DB020B35F5CF</td>
                    <td>Token của tài khoản BIDV cần GET</td>
                </tr>
            </table>

            <div class="api-response">
                <h2 class="api-subtitle">Response</h2>
                <pre class="json-display"></pre>
            </div>
        </div>
    </div>
</div>

{{-- Techcombank --}}
<div class="box">
    <div class="API-items">
        <h1 class="api-title">Tài liệu API Techcombank</h1>

        <div class="api-content">
            <h2 class="api-subtitle">URL API</h2>
            <div class="api-url">
                <p class="api-url-base">https:</p>
                <p class="api-url-path">//api.web2m.com/historyapivtb/password/sotaikhoan/token</p>
            </div>

            <table class="api-table">
                <tr>
                    <th>Tham số</th>
                    <th>Dữ liệu</th>
                    <th>Ví dụ</th>
                    <th>Chú thích</th>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>string</td>
                    <td>ABC123456</td>
                    <td>Mật khẩu sử dụng Internet Banking tương ứng với tài khoản đã add</td>
                </tr>
                <tr>
                    <td>sotaikhoan</td>
                    <td>string</td>
                    <td>123456789123</td>
                    <td>Số tài khoản Techcombank</td>
                </tr>
                <tr>
                    <td>Token</td>
                    <td>string</td>
                    <td>39D6670A-1B9A-A12B-ADB0-DB020B35F5CF</td>
                    <td>Token của tài khoản Techcombank cần GET</td>
                </tr>
            </table>

            <div class="api-response">
                <h2 class="api-subtitle">Response</h2>
                <pre class="json-display"></pre>
            </div>
        </div>
    </div>
</div>

{{-- Seabank --}}
<div class="box">
    <div class="API-items">
        <h1 class="api-title">Tài liệu API Seabank</h1>

        <div class="api-content">
            <h2 class="api-subtitle">URL API</h2>
            <div class="api-url">
                <p class="api-url-base">https:</p>
                <p class="api-url-path">//api.web2m.com/historyapivtb/password/sotaikhoan/token</p>
            </div>

            <table class="api-table">
                <tr>
                    <th>Tham số</th>
                    <th>Dữ liệu</th>
                    <th>Ví dụ</th>
                    <th>Chú thích</th>
                </tr>
                <tr>
                    <td>Token</td>
                    <td>string</td>
                    <td>39D6670A-1B9A-A12B-ADB0-DB020B35F5CF</td>
                    <td>Token của tài khoản Seabank cần GET</td>
                </tr>
            </table>

            <div class="api-response">
                <h2 class="api-subtitle">Response</h2>
                <pre class="json-display"></pre>
            </div>
        </div>
    </div>
</div>

{{-- ACB --}}
<div class="box">
    <div class="API-items">
        <h1 class="api-title">Tài liệu API ACB</h1>

        <div class="api-content">
            <h2 class="api-subtitle">URL API</h2>
            <div class="api-url">
                <p class="api-url-base">https:</p>
                <p class="api-url-path">//api.web2m.com/historyapivtb/password/sotaikhoan/token</p>
            </div>

            <table class="api-table">
                <tr>
                    <th>Tham số</th>
                    <th>Dữ liệu</th>
                    <th>Ví dụ</th>
                    <th>Chú thích</th>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>string</td>
                    <td>ABC123456</td>
                    <td>Mật khẩu sử dụng Internet Banking tương ứng với tài khoản đã add</td>
                </tr>
                <tr>
                    <td>sotaikhoan</td>
                    <td>string</td>
                    <td>123456789123</td>
                    <td>Số tài khoản ACB</td>
                </tr>
                <tr>
                    <td>Token</td>
                    <td>string</td>
                    <td>39D6670A-1B9A-A12B-ADB0-DB020B35F5CF</td>
                    <td>Token của tài khoản ACB cần GET</td>
                </tr>
            </table>

            <div class="api-response">
                <h2 class="api-subtitle">Response</h2>
                <pre class="json-display"></pre>
            </div>
        </div>
    </div>
</div>

{{-- MB Bank --}}
<div class="box">
    <div class="API-items">
        <h1 class="api-title">Tài liệu API MB Bank</h1>

        <div class="api-content">
            <h2 class="api-subtitle">URL API</h2>
            <div class="api-url">
                <p class="api-url-base">https:</p>
                <p class="api-url-path">//api.web2m.com/historyapivtb/password/sotaikhoan/token</p>
            </div>

            <table class="api-table">
                <tr>
                    <th>Tham số</th>
                    <th>Dữ liệu</th>
                    <th>Ví dụ</th>
                    <th>Chú thích</th>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>string</td>
                    <td>ABC123456</td>
                    <td>Mật khẩu sử dụng Internet Banking tương ứng với tài khoản đã add</td>
                </tr>
                <tr>
                    <td>sotaikhoan</td>
                    <td>string</td>
                    <td>123456789123</td>
                    <td>Số tài khoản MBBank</td>
                </tr>
                <tr>
                    <td>Token</td>
                    <td>string</td>
                    <td>39D6670A-1B9A-A12B-ADB0-DB020B35F5CF</td>
                    <td>Token của tài khoản MBBank cần GET</td>
                </tr>
            </table>

            <div class="api-response">
                <h2 class="api-subtitle">Response</h2>
                <pre class="json-display"></pre>
            </div>
        </div>
    </div>
</div>

{{-- TP Bank --}}
<div class="box">
    <div class="API-items">
        <h1 class="api-title">Tài liệu API TPBank</h1>

        <div class="api-content">
            <h2 class="api-subtitle">URL API</h2>
            <div class="api-url">
                <p class="api-url-base">https:</p>
                <p class="api-url-path">//api.web2m.com/historyapivtb/password/sotaikhoan/token</p>
            </div>

            <table class="api-table">
                <tr>
                    <th>Tham số</th>
                    <th>Dữ liệu</th>
                    <th>Ví dụ</th>
                    <th>Chú thích</th>
                </tr>
                <tr>
                    <td>Token</td>
                    <td>string</td>
                    <td>39D6670A-1B9A-A12B-ADB0-DB020B35F5CF</td>
                    <td>Token của tài khoản TPBank cần GET</td>
                </tr>
            </table>

            <div class="api-response">
                <h2 class="api-subtitle">Response</h2>
                <pre class="json-display"></pre>
            </div>
        </div>
    </div>
</div>



