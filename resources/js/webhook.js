const apiDataArray = [
    {   
        'Content-Type': 'application/json',
        'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJ1c2VyIjoiMDkwMjUwNjA5OSIsImltZWkiOiI0MDE0NC1iZmNiNzJjMGIyMjczNjZiZy'  
    },
    {
    "status": true,
    "data": [
        {
            "id": "753632", //mã định danh duy nhất của giao dịch
            "type": "IN", //Loại giao dịch
            "transactionID": "24213", //Mã giao dịch từ phía ngân hàng
            "amount": "100000", // số tiền giao dịch
            "description": "NAP14838 GD 941234-010624 16:56:30",
            "date": "01/04/2024", // nội dung giao dịch
            "bank": "ACB"
        },
        {
            "id": "753633",
            "type": "IN",
            "transactionID": "24212",
            "amount": "300000",
            "description": "IB NAP1531",
            "date": "01/04/2024",
            "bank": "ACB"
        },
        {
            "id": "753634",
            "type": "IN",
            "transactionID": "24211",
            "amount": "300000",
            "description": "NAP14076 GD 063532-010624 16:31:49",
            "date": "01/04/2024",
            "bank": "ACB"
        }
    ]
},
{
    "status": true, // Bắt buộc phải có để xác nhận đã nhận được sự kiện. Nếu không sẽ gửi liên tục các sự kiện đã gửi.
    "msg": "Ok"
},

];
function syntaxHighlight(json) {
    if (typeof json != 'string') {
        json = JSON.stringify(json, undefined, 2);
    }
    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
        var cls = 'num';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'key';
            } else {
                cls = 'string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'boolean';
        } else if (/null/.test(match)) {
            cls = 'null';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
}

// Tìm tất cả các phần tử có class "json-display"
document.addEventListener('DOMContentLoaded', function() {
    const jsonDisplays = document.querySelectorAll('.json-display');

    // Lặp qua từng phần tử và chèn dữ liệu JSON tương ứng
    jsonDisplays.forEach(function(display, index) {
        // Sử dụng dữ liệu từ apiDataArray tương ứng với chỉ số
        if (apiDataArray[index]) {
            display.innerHTML = syntaxHighlight(apiDataArray[index]);
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    var apiTitles = document.querySelectorAll('.api-title');

    apiTitles.forEach(function(title) {
        title.addEventListener('click', function() {
            var apiContent = this.nextElementSibling;

            // Kiểm tra và thêm/xóa lớp 'open'
            if (apiContent.classList.contains('open')) {
                apiContent.classList.remove('open');
            } else {
                // Ẩn các phần tử khác đang mở
                document.querySelectorAll('.api-content.open').forEach(function(content) {
                    content.classList.remove('open');
                });

                apiContent.classList.add('open');
            }
        });
    });

    // Ẩn tất cả các phần tử .api-content khi trang được tải
    var apiContents = document.querySelectorAll('.api-content');
    apiContents.forEach(function(content) {
        content.classList.remove('open');
    });
});
