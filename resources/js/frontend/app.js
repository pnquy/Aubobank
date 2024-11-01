import $ from "jquery";

window.$ = window.jQuery = $;
require("bootstrap");

// Kiểm tra màn hình có kích thước lớn hơn hoặc bằng lg
function isLg() {
    return window.matchMedia("(min-width: 992px)").matches;
}

// Kiểm tra màn hình có kích thước lớn hơn hoặc bằng md
function isMd() {
    return window.matchMedia("(min-width: 768px)").matches;
}

// Kiểm tra màn hình có kích thước lớn hơn hoặc bằng sm
function isSm() {
    return window.matchMedia("(min-width: 576px)").matches;
}

// Kiểm tra màn hình có kích thước lớn hơn hoặc bằng xl
function isXl() {
    return window.matchMedia("(min-width: 1200px)").matches;
}

$(document).ready(function () {
    $(".sidebar-menu-item").click(function () {
        var subMenu = $(this).find(".sidebar-menu__sub");
        if (subMenu.is(":visible")) {
            subMenu.slideUp(200);
        } else {
            subMenu.slideDown(200);
        }
    });

    const toggleSidebar = $("#sidebarToggle");
    const sidebarContent = $("#sidebarContent");

    toggleSidebar.click(function () {
        if (sidebarContent.is(":visible")) {
            sidebarContent.slideUp(200);
        } else {
            sidebarContent.slideDown(200);
        }
    });

    $(window).resize(function () {
        if (isLg() && !sidebarContent.is(":visible")) {
            sidebarContent.slideDown(200);
        }
    });

    // open / close Content Header Menu:
    const toggleContentHeaderMenu = $("#toggleContentHeaderMenu");
    const contentHeaderMenu = $("#contentHeaderMenu");

    toggleContentHeaderMenu.click(function () {
        if (contentHeaderMenu.is(":visible")) {
            contentHeaderMenu.slideUp(200);
        } else {
            contentHeaderMenu.slideDown(200);
        }
    });

    // open / close Content Header Notify:
    const toggleContentHeaderNotify = $("#toggleContentHeaderNotify");
    const contentHeaderNotify = $("#contentHeaderNotify");

    toggleContentHeaderNotify.click(function () {
        if (contentHeaderNotify.is(":visible")) {
            contentHeaderNotify.slideUp(200);
        } else {
            contentHeaderNotify.slideDown(200);
        }
    });

    // open / close Chat Screen:
    const toggleChatScreen = $("#toggleChatScreen");
    const chatScreen = $("#chatScreen");

    toggleChatScreen.click(function () {
        if (chatScreen.is(":visible")) {
            chatScreen.slideUp(200);
        } else {
            chatScreen.slideDown(200);
        }
    });

    // open modal

    $(".open-modal").click(function () {
        console.log("Click");
        var target = $(this).data("target");
        console.log("$(target): ", $(target));
        $(target).modal("show");
    });

    // Khi nhấn vào một nút đóng modal
    $(".close-modal").click(function () {
        var target = $(this).data("target");
        $(target).modal("hide");
    });

    // prev next thông báo

    let currentNotifyIndex = 0;
    let totalNotify = $(".notify-list .notify-card").length;

    // $(".notify-list .notify-card").hide(); // Ẩn tất cả các .notify-card trong .notify-list
    $(".notify-list .notify-card").eq(currentNotifyIndex).show(); // Hiện .notify-card có chỉ số currentNotifyIndex

    $(".change-notify-btn").on("click", function () {
        if ($(this).hasClass("change-notify-prev")) {
            currentNotifyIndex =
                currentNotifyIndex > 0 ? currentNotifyIndex - 1 : 0;
        } else if ($(this).hasClass("change-notify-next")) {
            currentNotifyIndex =
                currentNotifyIndex < totalNotify - 1
                    ? currentNotifyIndex + 1
                    : totalNotify - 1;
        }
        console.log("currentNotifyIndex: ", currentNotifyIndex);
        $(".notify-list .notify-card").hide(); // Ẩn tất cả các .notify-card trong .notify-list
        $(".notify-list .notify-card").eq(currentNotifyIndex).show(); // Hiện .notify-card có chỉ số currentNotifyIndex
        $(".change-notify-btn").removeClass("change-notify-btn-active");
        $(this).addClass("change-notify-btn-active");
    });

    // $(".table-sort-icon").on("click", function () {
    //     // // nếu đang active
    //     // if ($(this).hasClass("table-sort-icon-active")) {
    //     //     // đang ASC (UP) => chuyển sang DESC (DOWN)
    //     //     if ($(this).hasClass("fa-arrow-up-wide-short")) {
    //     //     }
    //     //     // đang DESC => chuyển sang ASC
    //     //     else if ($(this).hasClass("fa-arrow-down-wide-short")) {
    //     //     }
    //     // }
    //     // // nếu ko active => DESC (DOWN)
    //     // else {
    //     // }

    //     if ($(this).hasClass("table-sort-icon-active")) {
    //         $(this).toggleClass(
    //             "fa-arrow-up-wide-short fa-arrow-down-wide-short"
    //         );
    //     } else {
    //         const others = $(".table-sort-icon");
    //         $(".table-sort-icon").removeClass(
    //             "fa-arrow-up-wide-short fa-arrow-down-wide-short table-sort-icon-active"
    //         );
    //         $(".table-sort-icon").addClass("fa-arrow-down-wide-short");
    //         $(this).addClass("table-sort-icon-active");
    //     }
    // });
});
