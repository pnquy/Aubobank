<?php

namespace App\Services;

use App\Models\MomoAccount;
use Illuminate\Support\Facades\Auth;

class MomoAccountService
{
    public function createMomoAccount($data)
    {
        // Thêm tài khoản MoMo vào database
        $momoAccount = new MomoAccount();
        $momoAccount->user_id = Auth::id();
        $momoAccount->phone_number = $data['phone'];
        $momoAccount->password = bcrypt($data['pass']); // Hash password
        $momoAccount->save();

        return $momoAccount;
    }
}
