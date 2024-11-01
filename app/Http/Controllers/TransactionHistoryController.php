<?php
// app/Http/Controllers/TransactionHistoryController.php

namespace App\Http\Controllers;

use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        // Lấy lịch sử nạp tiền của user hiện tại
        $transactions = TransactionHistory::where('user_id', Auth::id())->get();

        // Truyền dữ liệu sang view
        return view('purchase.card', compact('transactions'));
    }
}
