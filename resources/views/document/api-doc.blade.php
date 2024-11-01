<div class="box">
    <div class="API-items">
        <h1 id="btn" class="api-title">{{ $title }}</h1>

        <div class="hid">
            <h2 class="api-subtitle">URL API</h2>
            <div class="link">
                <p class="api-url">https:</p>
                <p class="api-url-path">{{ $url }}</p>
            </div>

            <table class="table-api">
                <tr>
                    <th>Tham số</th>
                    <th>Dữ liệu</th>
                    <th>Ví dụ</th>
                    <th>Chú thích</th>
                </tr>
                @foreach($parameters as $param)
                <tr>
                    <td class="text">{{ $param['name'] }}</td>
                    <td>{{ $param['type'] }}</td>
                    <td>{{ $param['example'] }}</td>
                    <td>{{ $param['note'] }}</td>
                </tr>
                @endforeach
            </table>

            <div class="res">
                <h2 class="api-response-title">Response</h2>
                <pre class="json-display"></pre>
            </div>
        </div>
    </div>
</div>
