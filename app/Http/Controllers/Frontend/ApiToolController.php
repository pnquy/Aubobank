<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;

class ApiToolController extends Controller
{

    public function  index()
    {
    }
    public function  testMomoTransactionCodeView()
    {
        return view('frontend.api_tool.test_momo_transaction_code');
    }
    public function  testWalletApiView()
    {
        $paymentGateways = PaymentGateway::getAllAvailablePaymentGatewaysByType(PaymentGateway::TYPES['WALLET']);
        return view('frontend.api_tool.test_wallet_api', compact('paymentGateways'));
    }
    public function  testBankApiView()
    {
        $paymentGateways = PaymentGateway::getAllAvailablePaymentGatewaysByType(PaymentGateway::TYPES['BANK']);
        return view('frontend.api_tool.test_bank_api', compact('paymentGateways'));
    }
    public function  createBankQrCode()
    {
        return view('frontend.api_tool.create_bank_qrcode');
    }
}
