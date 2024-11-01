<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntegratedController extends Controller
{
    public function showCard()
    {
        return view('intergrated.card');
    }
    public function whm()
    {
        return view('intergrated.whm');
    }
}
