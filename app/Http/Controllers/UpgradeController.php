<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpgradeController extends Controller
{
    public function upgrade()
    {
        return view('upgrade.card');
    }
}
