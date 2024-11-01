<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;

class EcaptchaControler extends Controller
{
    //

    public function index()
    {
    }

    public function historyView()
    {
        return view('frontend.ecaptcha.ecaptcha_history');
    }

    public function paymentGatewayDocumentView(Request $request, PaymentGateway $paymentGateway)
    {
        return view('frontend.ecaptcha.ecaptcha_document');
    }
}
