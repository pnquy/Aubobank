const showInfoModal = (
    id,
    { title, description } = {},
    { submitBtnLabel, backBtnLabel } = {},
    onSubmit
) => {
    // console.log("id: ", id);
    const modalEle = $(`#${id}`);
    // console.log("modalEle: ", modalEle);

    if (title) {
        const titleEle = modalEle.find(".info-modal-title");
        titleEle.text(title);
    }
    if (description) {
        const descriptionEle = modalEle.find(".info-modal-description");
        descriptionEle.text(description);
    }

    if (onSubmit && typeof onSubmit === "function") {
        customSubmitInfoModalBtn(id, onSubmit);
    }

    if (submitBtnLabel) {
        const submitBtnEle = modalEle.find(".info-modal-submit-btn");
        submitBtnEle.text(submitBtnLabel);
    }

    // console.log("show show show: ", modalEle);

    // console.log("type of modalEle.modal: ", typeof modalEle.modal);
    // console.log("modalEle.modal: ", modalEle.modal);
    modalEle.modal("show");
    // console.log("modalEle: ", modalEle);
};

const hideInfoModal = (id) => {
    // console.log("id: ", id);
    const modalEle = $(`#${id}`);
    modalEle.modal("hide");
};

const customBackInfoModalBtn = (id, callback) => {
    const modalEle = $(`#${id}`);
    const backBtn = modalEle.find(".info-modal-footer-btn.info-modal-back-btn");
    backBtn.off("click");
    backBtn.on("click", function () {
        if (callback && typeof callback === "function") {
            callback();
        } else {
            modalEle.modal("hide");
        }
    });
};

const customSubmitInfoModalBtn = (id, callback) => {
    const modalEle = $(`#${id}`);
    const submitBtn = modalEle.find(
        ".info-modal-footer-btn.info-modal-submit-btn"
    );

    submitBtn.off("click");
    submitBtn.on("click", function () {
        if (callback && typeof callback === "function") {
            console.log("Xử lý: ", submitBtn);
            submitBtn.text("Đang xử lý");

            // Xóa sự kiện click trên nút để ngăn người dùng click lại trong khi đang xử lý
            submitBtn.off("click");

            callback();
        } else {
            modalEle.modal("hide");
        }
    });
};

const refreshSubmitBtn = () => {};

const initInfoModal = (id) => {
    const modalEle = $(`#${id}`);
    modalEle.find(".info-modal-footer-btn").on("click", function () {
        modalEle.modal("hide");
    });
};

export {
    showInfoModal,
    customBackInfoModalBtn,
    customSubmitInfoModalBtn,
    initInfoModal,
};
