// avatar-upload.js
document.addEventListener('DOMContentLoaded', () => {
    const avatarForm = document.getElementById('avatarForm');
    if (avatarForm) {
        avatarForm.addEventListener('submit', function (event) {
            event.preventDefault();
            uploadAvatar();
        });
    }
});

function uploadAvatar() {
    const formData = new FormData();
    const avatarInput = document.getElementById('avatarInput');
    
    if (avatarInput.files.length > 0) {
        formData.append('avatar', avatarInput.files[0]);
    } else {
        alert('Vui lòng chọn một ảnh để tải lên.');
        return;
    }

    // Lấy token CSRF từ meta tag trong trang
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/update-avatar', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Xử lý thành công
            alert('Avatar đã được cập nhật thành công.');
            // Cập nhật hình ảnh avatar trên trang nếu cần
            document.querySelector('.avatar-profile img').src = '/storage/avatars/' + data.filename;
        } else {
            // Xử lý lỗi
            alert('Có lỗi xảy ra khi cập nhật avatar: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Có lỗi xảy ra:', error);
        alert('Có lỗi xảy ra khi cập nhật avatar.');
    });
}
