<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog; // Thay đổi tên model nếu khác
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::all(); // Lấy tất cả dữ liệu từ bảng activity_log
        dd($logs);
        return view('activity-logs', ['logs' => $logs]);
    }
}
