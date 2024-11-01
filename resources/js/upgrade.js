document.addEventListener('DOMContentLoaded', function () {
    // Tạo định dạng tiền tệ Việt Nam
    const currencyFormatter = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });

    // Lấy tất cả các phần tử form với class 'time'
    const forms = document.querySelectorAll('.time');

    forms.forEach(form => {
        // Lấy phần tử select và giá cơ bản từ form
        const durationSelect = form.querySelector('.durationSelect');
        const priceElement = form.closest('.package').querySelector('.price');
        
        if (durationSelect && priceElement) {
            const priceInput = form.querySelector('.priceInput');
            const additionalInfoContainer = form.querySelector('.additionalInfoContainer');

            // Lấy giá cơ bản từ phần tử price
            const basePrice = parseFloat(priceElement.getAttribute('data-base-price'));

            if (priceInput && additionalInfoContainer) {
                durationSelect.addEventListener('change', function () {
                    // Lấy giá trị từ tùy chọn đã chọn
                    const duration = parseInt(durationSelect.value);

                    if (duration) {
                        // Tính giá mới dựa trên giá cơ bản và tùy chọn
                        const newPrice = basePrice * duration;
                        priceInput.value = currencyFormatter.format(newPrice);
                        additionalInfoContainer.style.display = 'block';
                    } else {
                        additionalInfoContainer.style.display = 'none';
                    }
                });
            }
        }
    });
});
