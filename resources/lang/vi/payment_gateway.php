<?php

return [

    "properties" => [
        "bank" => [
            "account_no" => "Số tài khoản",
            "account_name" => "Tên tài khoản",
            "created_at" => "Thời gian thêm",
            "last_cron" => "Lần cron gần nhất",
            "action" => "Thao tác"
        ],
        "wallet" => [
            "account_no" => "Số điện thoại",
            "account_name" => "Tên tài khoản",
            "created_at" => "Thời gian thêm",
            "last_cron" => "Lần cron gần nhất",
            "action" => "Thao tác"
        ],
        "thesieure" => [
            "account_no" => "Số điện thoại",
            "account_name" => "Tên tài khoản",
            "created_at" => "Thời gian thêm",
            "last_cron" => "Lần cron gần nhất",
            "cookie_status" => "Trạng thái cookies",
            "action" => "Thao tác"
        ]
    ],

    "list" => [
        "table" => [
            "action" => [
                "label" => "Thao tác",
                "button" => [
                    "pause" => "Tạm dừng",
                    "fixAccount" => "Sửa tài khoản",
                    "update" => "update",
                    "receiveHistory" => "Lịch sử nhận tiền",
                    "transferHistory" => "Lịch sử chuyển tiền",
                    "getToken" => "getToken",
                    "transferMoney" => "transferMoney",
                    "remove" => "remove",
                ]
            ]
        ]
    ],

    "add" => [
        "form" => [
            "wallet" => [
                "account_no" => [
                    "label" => "Số điện thoại :app_name",
                    "placeholder" => "Nhập chính xác số điện thoại sử dụng :app_name"
                ],
                "password" => [
                    "label" => "Mật khẩu :app_name",
                    "placeholder" => "Nhập mật khẩu sử dụng :app_name"
                ],

                "otp" => [
                    "label" => "Nhập mã otp",
                    "placeholder" => "Nhập mã otp"
                ],

                "button" => [
                    "add" => "Lấy mã OTP",
                    "send_otp" => "Xác thực OTP"
                ]
            ],
            "bank" => [
                "account_no" => [
                    "label" => "Số tài khoản :app_name",
                    "placeholder" => "Nhập chính xác số tài khoản sử dụng :app_name"
                ],
                "account_name" => [
                    "label" => "Tên tài khoản :app_name",
                    "placeholder" => "Nhập chính xác tên tài khoản sử dụng :app_name"
                ],
                "password" => [
                    "label" => "Mật khẩu :app_name",
                    "placeholder" => "Nhập mật khẩu sử dụng :app_name"
                ],
                "button" => [
                    "add" => "Thêm tài khoản"
                ]
            ],
            "thesieure" => [
                "account_no" => [
                    "label" => "Tên đăng nhập :app_name",
                    "placeholder" => "Nhập chính xác tên đăng nhập sử dụng :app_name"
                ],
                "cookie" => [
                    "label" => "Nhập cookie :app_name",
                    "placeholder" => "Nhập cookie sử dụng :app_name"
                ],
                "button" => [
                    "add" => "Thêm tài khoản"
                ]
            ],

        ],


    ]
];
