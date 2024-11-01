<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuBankController extends Controller
{
    public function index()
    {
        return view('menu-bank'); // Thay 'menu-bank' bằng tên view của bạn
    }
}
