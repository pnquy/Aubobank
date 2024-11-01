<?php

namespace App\Http\Controllers\Frontend;

use App\Mock\MockData;
use App\Models\PaymentGateway;


/**
 * Class HomeController.
 */
class HomeController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */


    public function index()
    {

        $paymentGateways = PaymentGateway::all();
        // dd($paymentGateways);

        return view('frontend.index', compact('paymentGateways'));
    }
}
