<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function apiv2()
    {
        return view('document.apidata-v2');
    }
    public function qr()
    {
        return view('document.webhook');
    }
}
