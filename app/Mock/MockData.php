<?php

namespace App\Mock;

use App\Models\PaymentGateway;


class MockData
{


    const PAYMENT_GATEWAYS = [
        [
            'id' => 1,
            'name' => "Ví điện tử Momo",
            'img' => "https://api.web2m.com/template/images/iconbank/momo.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['READY'],
            'brand' =>  PaymentGateway::BRANDS['MOMO'],

        ],
        [
            'id' => 2,
            'name' => "Ngân hàng ACB (Á Châu)",
            'img' => "https://api.web2m.com/template/images/iconbank/acb.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['MAINTENANCE'],
            'brand' =>  PaymentGateway::BRANDS['ACB'],

        ],
        [
            'id' => 3,
            'name' => "Ngân hàng Techcombank",
            'img' => "https://api.web2m.com/template/images/iconbank/techcombank.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['COMMING_SOON'],
            'brand' =>  PaymentGateway::BRANDS['TECHCOMBANK'],

        ],
        [
            'id' => 4,
            'name' => "Ngân hàng Vietcombank",
            'img' => "https://api.web2m.com/template/images/iconbank/vietcombank.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['READY'],
            'brand' =>  PaymentGateway::BRANDS['VIETCOMBANK'],

        ],
        [
            'id' => 5,
            'name' => "Ví điện thử Zalopay",
            'img' => "https://api.web2m.com/template/images/iconbank/zalopay.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['MAINTENANCE'],
            'brand' =>  PaymentGateway::BRANDS['ZALOPAY'],

        ],
        [
            'id' => 6,
            'name' => "Ngân hàng Tiền Phong",
            'img' => "https://api.web2m.com/template/images/iconbank/tpbank.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['COMMING_SOON'],
            'brand' =>  PaymentGateway::BRANDS['TPBANK'],

        ],
        [
            'id' => 7,
            'name' => "Ngân hàng Mbbank",
            'img' => "https://api.web2m.com/template/images/iconbank/mbbank.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['READY'],
            'brand' =>  PaymentGateway::BRANDS['MBBANK'],

        ],
        [
            'id' => 8,
            'name' => "Thẻ siêu rẻ",
            'img' => "https://api.web2m.com/template/images/iconbank/thesieure.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['MAINTENANCE'],
            'brand' =>  PaymentGateway::BRANDS['THESIEURE'],

        ],
        [
            'id' => 9,
            'name' => "Viettelpay",
            'img' => "https://api.web2m.com/template/images/iconbank/viettelpay.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['COMMING_SOON'],
            'brand' =>  PaymentGateway::BRANDS['VIETTELPAY'],

        ],
    ];
}
