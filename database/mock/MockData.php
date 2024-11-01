<?php

namespace Database\Mock;

use App\Models\PaymentGateway;


class MockData
{

    const PAYMENT_GATEWAYS_TYPES = [
        'PRIVATE' => 'Cá nhân',
        'TEAM' => 'Nhóm',
    ];


    const PAYMENT_GATEWAYS = [
        [
            'id' => 1,
            'name' => "MOMO",
            'img' => "https://api.web2m.com/template/images/iconbank/momo.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['READY'],
            'brand' =>  PaymentGateway::BRANDS['MOMO'],
            'type' =>  self::PAYMENT_GATEWAYS_TYPES['PRIVATE']
        ],
        [
            'id' => 2,
            'name' => "ACB",
            'img' => "https://api.web2m.com/template/images/iconbank/acb.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['MAINTENANCE'],
            'brand' =>  PaymentGateway::BRANDS['ACB'],
            'type' =>  self::PAYMENT_GATEWAYS_TYPES['PRIVATE']
        ],
        [
            'id' => 3,
            'name' => "TECHCOMBANK",
            'img' => "https://api.web2m.com/template/images/iconbank/techcombank.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['COMMING_SOON'],
            'brand' =>  PaymentGateway::BRANDS['TECHCOMBANK'],
            'type' =>  self::PAYMENT_GATEWAYS_TYPES['PRIVATE']
        ],
        [
            'id' => 4,
            'name' => "VIETCOMBANK",
            'img' => "https://api.web2m.com/template/images/iconbank/vietcombank.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['READY'],
            'brand' =>  PaymentGateway::BRANDS['VIETCOMBANK'],
            'type' =>  self::PAYMENT_GATEWAYS_TYPES['PRIVATE']
        ],
        [
            'id' => 5,
            'name' => "ZALOPAY",
            'img' => "https://api.web2m.com/template/images/iconbank/zalopay.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['MAINTENANCE'],
            'brand' =>  PaymentGateway::BRANDS['ZALOPAY'],
            'type' =>  self::PAYMENT_GATEWAYS_TYPES['PRIVATE']
        ],
        [
            'id' => 6,
            'name' => "TPBANK",
            'img' => "https://api.web2m.com/template/images/iconbank/tpbank.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['COMMING_SOON'],
            'brand' =>  PaymentGateway::BRANDS['TPBANK'],
            'type' =>  self::PAYMENT_GATEWAYS_TYPES['PRIVATE']
        ],
        [
            'id' => 7,
            'name' => "MBBANK",
            'img' => "https://api.web2m.com/template/images/iconbank/mbbank.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['READY'],
            'brand' =>  PaymentGateway::BRANDS['MBBANK'],
            'type' =>  self::PAYMENT_GATEWAYS_TYPES['PRIVATE']
        ],
        [
            'id' => 8,
            'name' => "THESIEURE",
            'img' => "https://api.web2m.com/template/images/iconbank/thesieure.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['MAINTENANCE'],
            'brand' =>  PaymentGateway::BRANDS['THESIEURE'],
            'type' =>  self::PAYMENT_GATEWAYS_TYPES['PRIVATE']
        ],
        [
            'id' => 9,
            'name' => "VIETTELPAY",
            'img' => "https://api.web2m.com/template/images/iconbank/viettelpay.svg",
            'count' => 10,
            'status' =>  PaymentGateway::STATUSES['COMMING_SOON'],
            'brand' =>  PaymentGateway::BRANDS['VIETTELPAY'],
            'type' =>  self::PAYMENT_GATEWAYS_TYPES['PRIVATE']
        ],
    ];
}
