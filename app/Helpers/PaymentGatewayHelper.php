<?php

namespace App\Helpers;

use App\Models\PaymentGateway;

class PaymentGatewayHelper
{
    public static function createDataForAddPaymentGatewayAccount(PaymentGateway $paymentGateway)
    {
        $brand = $paymentGateway->brand;
        extract(PaymentGateway::BRANDS);

        $paymentGatewayType = '';
        $inputs = [];

        switch ($brand) {
            case $MOMO:
            case $ZALOPAY:
            case $VIETTELPAY:
                $paymentGatewayType = 'wallet';
                $inputs = [
                    (object) [
                        'name' => 'accountNo',
                        'type' => 'text',
                    ],
                    (object) [
                        'name' => 'password',
                        'type' => 'password',
                    ],
                ];
                break;

            case $THESIEURE:
                $paymentGatewayType = 'thesieure';
                $inputs = [
                    (object) [
                        'name' => 'accountNo',
                        'type' => 'text',
                    ],
                    (object) [
                        'name' => 'cookie',
                        'type' => 'text',
                    ],
                ];
                break;

            case $ACB:
            case $TECHCOMBANK:
            case $VIETCOMBANK:
            case $TPBANK:
            case $MBBANK:
            default:
                $paymentGatewayType = 'bank';
                $inputs = [
                    (object) [
                        'name' => 'accountNo',
                        'type' => 'text',
                    ],
                    (object) [
                        'name' => 'accountName',
                        'type' => 'text',
                    ],
                    (object) [
                        'name' => 'password',
                        'type' => 'password',
                    ],
                ];
                break;
        }

        return (object) compact('paymentGatewayType', 'inputs');
    }
}
