const showFormErrorToast = (id, errors) => {
    console.log("errors: ", errors);
    const toastEle = $(`#${id}`);
    toastEle.toast("show");

    const errorListEle = toastEle.find(".info-toast-list");
    errorListEle.empty();

    if (errors) {
        for (let i = 0; i < errors.length; i++) {
            const error = errors[i];
            const errorItem = $(
                '<li class="text-white info-toast-item"></li>'
            ).text(error);
            errorListEle.append(errorItem);
        }
        toastEle.toast("show");
    }
};

const showSuccessToast = (id, { title, description }) => {
    const toastEle = $(`#${id}`);
    toastEle.toast("show");

    if (title) {
        const titleEle = toastEle.find(".info-toast-title");
        titleEle.text(title);
    }
    if (description) {
        const descriptionEle = toastEle.find(".info-toast-description");
        if (description.length > 20) {
            description = description.substring(0, 20) + "...";
        }
        descriptionEle.text(description);
    }
    toastEle.toast("show");
};

export { showFormErrorToast, showSuccessToast };
