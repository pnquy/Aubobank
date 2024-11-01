<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Package;


class PackageController extends Controller
{
    public function  index()
    {
        $packages = Package::with('paymentGatewayPackages.paymentGateway')->with('userPackages')->get();
        return view('frontend.upgrade.upgrade_account', compact('packages'));
    }
}
