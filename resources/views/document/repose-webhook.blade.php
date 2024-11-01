<table class="table" id="tblRequest">
    <thead>
        <tr>
            <th>Method</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong class="">Header</strong></td>
            <td>
                <pre class="json-display"><code class="bash"></code></pre>
            </td>
        </tr>
        <tr>
            <td><strong class="">Params POST</strong></td>
            <td>
                <pre class="json-display"><code class="bash"></code></pre>
            </td>
        </tr>
        <tr>
            <td><strong>Response</strong></td>
            <td>
                <pre class="json-display"><code class="php"></code></pre>
            </td>
        </tr>
        <tr>
            <td><strong>Code mẫu</strong></td>
            <td>
                <?php
                $code = <<<'EOD'
<?php

$accessToken = 'YOUR_ACCESS_TOKEN'; // Thay YOUR_ACCESS_TOKEN bằng Access Token thực tế
$receivedData = file_get_contents('php://input'); // Nhận dữ liệu từ webhook

// Kiểm tra xem tiêu đề Authorization có tồn tại trong yêu cầu
if (isset($_SERVER['HTTP_AUTHORIZATION']) && strpos($_SERVER['HTTP_AUTHORIZATION'], 'Bearer ') === 0) {
    $bearerToken = substr($_SERVER['HTTP_AUTHORIZATION'], 7); // Lấy chuỗi token sau 'Bearer '
    
    // Kiểm tra xem chữ ký HMAC-SHA256 của bearerToken và imei có khớp với accessToken
    if ($accessToken === $bearerToken) {
        // Dữ liệu hợp lệ, tiếp tục xử lý
        $data = json_decode($receivedData, true);
        
        // Xử lý dữ liệu tại đây
        $response = array(
            "status" => true,
            "msg" => "OK"
        );
        
        echo json_encode($response);
    } else {
        // Chữ ký không khớp, từ chối yêu cầu
        http_response_code(401); // Unauthorized
        echo 'Chữ ký không hợp lệ.';
    }
} else {
    // Tiêu đề Authorization không tồn tại hoặc không hợp lệ
    http_response_code(401); // Unauthorized
    echo 'Access Token không được cung cấp hoặc không hợp lệ.';
}

?>
EOD;

                highlight_string($code);
                ?>
            </td>
        </tr>
        <tr>
            <td><strong>.htaccess Rewrite URL (Nếu lỗi Header)</strong></td>
            <td>
                <pre><code class="bash">
# Thêm quy tắc cho header Authorization vào file .htaccess
RewriteEngine On
RewriteCond %{HTTP:Authorization} ^(.*)
RewriteRule .* - [e=HTTP_AUTHORIZATION:%1]
                </code></pre>
            </td>
        </tr>
    </tbody>
</table>
