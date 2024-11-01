<?php

namespace App\Views\Composers\Frontend;

use App\Models\PaymentGateway;
use Illuminate\View\View;

class SidebarComposer
{

    const DASHBOARD_ICON = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>';



    const PAYMENT_GATEWAY_ICON = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-command">
                                    <path
                                        d="M18 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3H6a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3V6a3 3 0 0 0-3-3 3 3 0 0 0-3 3 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 3 3 0 0 0-3-3z">
                                    </path>
                                </svg>';

    const ECAPTCHAT_ICON = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-slack">
                                <path
                                    d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z">
                                </path>
                                <path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"></path>
                                <path
                                    d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z">
                                </path>
                                <path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"></path>
                                <path
                                    d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z">
                                </path>
                                <path d="M15.5 19H14v1.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z"></path>
                                <path
                                    d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z">
                                </path>
                                <path d="M8.5 5H10V3.5C10 2.67 9.33 2 8.5 2S7 2.67 7 3.5 7.67 5 8.5 5z"></path>
                            </svg>';


    const API_DOCUMENT_ICON = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>';
    const API_TOOL_ICON = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-briefcase">
                            <rect x="2" y="7" width="20" height="14" rx="2"
                                ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>';
    const USER_ICON = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>';
    const INTEGRATION_ICON = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-link">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                            </svg>';
    const REPUTABLE_WEBTISE_ICON = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-zap">
                                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                </svg>';
    const UPGRAGE_ICON = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-package">
                            <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                            </path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>';

    const HOSTING_ICON = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-terminal">
                            <polyline points="4 17 10 11 4 5"></polyline>
                            <line x1="12" y1="19" x2="20" y2="19"></line>
                        </svg>';

    const SCOINT_ICON = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-dollar-sign">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>';





    public function compose(View $view)
    {

        $paymentGateways = PaymentGateway::getAllAvailablePaymentGateways();
        extract(PaymentGateway::BRANDS);


        $paymentGatewaySubMenu =  [];
        foreach ($paymentGateways as $paymentGateway) {
            $paymentGatewaySubMenu[] = [
                'title' => $paymentGateway->name,
                'link' => route('frontend.payment_gateway.index', ['paymentGateway' => $paymentGateway->brand]),
            ];
        }



        $vietcombankPaymentGateway = PaymentGateway::where('brand', $VIETCOMBANK)->first();
        $mbbankPaymentGateway = PaymentGateway::where('brand', $MBBANK)->first();
        $ecaptchaSubMenu = [
            [
                'title' => 'Lịch sử ecaptcha',
                'link' =>  route('frontend.ecaptcha.history_view'),
            ],
            [
                'title' => 'Tài liệu ecaptcha ' . $vietcombankPaymentGateway->name,
                'link' => route('frontend.ecaptcha.payment_gateway.index', ['paymentGateway' => $vietcombankPaymentGateway->brand]),
            ],
            [
                'title' => 'Tài liệu ecaptcha ' . $mbbankPaymentGateway->name,
                'link' => route('frontend.ecaptcha.payment_gateway.index', ['paymentGateway' => $mbbankPaymentGateway->brand]),
            ]
        ];


        $menu = [
            [
                "title" => "Tổng quan",
                "link" =>  route('frontend.home.dashboard'),
                "leftIcon" => self::DASHBOARD_ICON
            ],
            [
                "title" => "Cổng thanh toán",
                "leftIcon" =>  self::PAYMENT_GATEWAY_ICON,
                "sub" => $paymentGatewaySubMenu,
            ],
            [
                "title" => "eCaptcha",
                "leftIcon" => self::ECAPTCHAT_ICON,
                "sub" => $ecaptchaSubMenu
            ],
            [
                "title" => "Tài liệu API",
                "leftIcon" =>  self::API_DOCUMENT_ICON,
                "sub" => [
                    [
                        "title" => "Tài liệu API Version 2",
                        "link" => "/",

                    ],
                    [
                        "title" => "Tài liệu API Momo Version ",
                        "link" => "/",

                    ],
                    [
                        "title" => "Tài liệu API Bank Version ",
                        "link" => "/",

                    ],
                ],
            ],
            [
                "title" => "Công cụ API",
                "leftIcon" =>  self::API_TOOL_ICON,
                "sub" => [
                    [
                        "title" => "Kiểm tra mã giao dịch MoMo",
                        "link" => route('frontend.api_tool.test_momo_transaction_code')

                    ],
                    [
                        "title" => "Kiểm thử API Ví điện tử",
                        "link" => route('frontend.api_tool.test_wallet_api')

                    ],
                    [
                        "title" => "Kiểm thử API ngân hàng",
                        "link" => route('frontend.api_tool.test_bank_api')

                    ],
                    [
                        "title" => "Tạo QRCode Ngân hàng",
                        "link" => route('frontend.api_tool.create_bank_qrcode')

                    ],
                ],
            ],
            [
                "title" => "Tích hợp",
                "leftIcon" => self::INTEGRATION_ICON,
                "sub" => [
                    [
                        "title" => "Wordpress",
                        "link" =>  route('frontend.integration.wordpress')

                    ],
                    [
                        "title" => "WHMCS",
                        "link" =>  route('frontend.integration.whmcs')

                    ],
                ],
            ],
            [
                "title" => "Hosting/VPS",
                "leftIcon" => self::HOSTING_ICON,
                "sub" => [
                    [
                        "title" => "Hosting cao cấp",
                        "link" => "/",

                    ],
                    [
                        "title" => "VPS giá rẻ",
                        "link" => "/",

                    ],
                    [
                        "title" => "VPS cao cấp",
                        "link" => "/",

                    ],
                ],
            ],
            [
                "title" => "Website uy tín",
                "link" =>  route('frontend.reputable_website'),
                "leftIcon" => self::REPUTABLE_WEBTISE_ICON,

            ],
            [
                "title" => "Nâng cấp",
                "link" =>  route('frontend.upgrade'),
                "leftIcon" => self::UPGRAGE_ICON,
            ],
            [
                "title" => "Hồ sơ",
                "link" => route('frontend.user.index'),
                "leftIcon" => self::USER_ICON,
            ],
            [
                "title" => "sCoint",
                "leftIcon" => self::SCOINT_ICON,
                "sub" => [
                    [
                        "title" => "Chuyển sCoint",
                        "link" => route('frontend.scoint.transfer_view'),

                    ],
                    [
                        "title" => "Lịch sử giao dịch",
                        "link" => route('frontend.scoint.history_view'),

                    ],
                    [
                        "title" => "Rút sCoint",
                        "link" => "/",

                    ],
                ],
            ],
        ];
        // dd($menu);
        $view->with("menu", $menu);
    }
}