import $ from "jquery";
import "jquery-validation";
import { showInfoModal } from "/js/frontend/global/components/modal.js";

window.$ = window.jQuery = $;

$(document).ready(function () {
    $('[id^="packageItem"]').on("change", function () {
        const packageItemEle = $(this);

        const timeLimitEle = packageItemEle.find('select[name="timeLimit"]');
        const totalPriceEle = packageItemEle.find('input[name="totalPrice"]');
        const priceEle = packageItemEle.find('input[name="price"]');
        const newTotalPrice = timeLimitEle.val() * priceEle.val();

        totalPriceEle.val(newTotalPrice);

        const paymentPriceGroup = totalPriceEle.closest(".payment-price-group");
        paymentPriceGroup.toggleClass("d-none", newTotalPrice === 0);
    });

    $('[id^="upgradeUserPackageFormBtn"]').click(function () {
        const packageId = $(this)
            .attr("id")
            .replace("upgradeUserPackageFormBtn", "");
        const upgradeUserPackageFormId = "#upgradeUserPackageForm" + packageId;
        const upgradeUserPackageFormEle = $(upgradeUserPackageFormId);

        const packageData = $(this).data("package");
        const packageName = packageData?.name;

        const userData = $(this).data("user");
        const userPhoneNumber = userData?.phoneNumber;

        const totalPriceInputValue = upgradeUserPackageFormEle
            .find('input[name="totalPrice"]')
            .val();

        const timeLimitValue = upgradeUserPackageFormEle
            .find('select[name="timeLimit"]')
            .val();

        if (!timeLimitValue) {
            return;
        }

        const description = `Xác nhận dùng ${totalPriceInputValue} sCoint để mua gói ${packageName} thời hạn ${timeLimitValue} tháng cho tài khoản ${userPhoneNumber}`;

        showInfoModal(
            "upgradeAccountSubmitModal",
            {
                title: "Thành công",
                description,
            },
            {},
            () => {
                upgradeUserPackageFormEle.submit();
            }
        );
    });
});
