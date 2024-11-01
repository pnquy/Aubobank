function generateRandomValue() {
    // Độ dài của chuỗi ngẫu nhiên
    var length = 16;

    // Các ký tự có thể có trong chuỗi
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;

    // Tạo chuỗi ngẫu nhiên
    var randomString = '';
    for (var i = 0; i < length; i++) {
        randomString += characters.charAt(Math.floor(Math.random() * charactersLength));
    }

    // Gán chuỗi ngẫu nhiên vào input
    document.getElementById('randomInput').value = randomString;
}

// Gán sự kiện cho nút khi DOM đã tải xong
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('generateButton').onclick = generateRandomValue;
});


// Hàm để sắp xếp bảng (cần thêm logic)
function sortTable(n) {
    const table = document.getElementById('dataTable');
    const rows = Array.from(table.querySelectorAll('tbody tr'));
    const sortedRows = rows.sort((a, b) => {
        const aText = a.cells[n].textContent.trim();
        const bText = b.cells[n].textContent.trim();
        return aText.localeCompare(bText);
    });
    const tbody = table.querySelector('tbody');
    sortedRows.forEach(row => tbody.appendChild(row));
}

// Lắng nghe sự kiện DOMContentLoaded chỉ một lần và xử lý tất cả các chức năng
document.addEventListener('DOMContentLoaded', function () {
    // Hiển thị form đặt lại mật khẩu
    window.showResetPasswordForm = function () {
        document.getElementById('profile-form').style.display = 'none';
        document.getElementById('reset-password-form').style.display = 'block';
    };

    // Hiển thị form cập nhật thông tin cá nhân
    window.showProfileForm = function () {
        document.getElementById('reset-password-form').style.display = 'none';
        document.getElementById('profile-form').style.display = 'block';
    };

    // Xác nhận checkbox khi gửi form hủy kích hoạt tài khoản
    const deactivationForm = document.getElementById('deactivationForm');
    if (deactivationForm) {
        deactivationForm.addEventListener('submit', function(event) {
            const checkbox = document.getElementById('confirmCheckbox');
            if (!checkbox.checked) {
                event.preventDefault(); // Ngăn không cho form được gửi đi
                alert('Bạn phải xác nhận trước khi huỷ kích hoạt tài khoản.');
            }
        });
    }

    // Hiển thị thông báo không có dữ liệu nếu tbody rỗng
    const tbody = document.getElementById('dataBody');
    const noDataMessage = document.getElementById('noDataMessage');
    if (tbody && noDataMessage) {
        if (tbody.rows.length === 0) {
            noDataMessage.style.display = 'block';
        } else {
            noDataMessage.style.display = 'none';
        }
    }

    // Xử lý upload ảnh đại diện
    const form = document.getElementById('avatarForm');
    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Cập nhật ảnh đại diện
                    document.querySelector('.avatar-profile img').src = `/storage/avatars/${data.filename}`;
                } else {
                    // Xử lý lỗi nếu có
                    console.error('Upload failed:', data.errors);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
});
