<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function momo()
    {
        return view('tool.momo');
    }
    public function wallet()
    {
        return view('tool.wallet');
    }
    public function bank()
    {
        return view('tool.bank');
    }
    public function qr()
    {
        return view('tool.qr');
    }
}
