<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\UserLog;

class LogController extends Controller
{
    public function index(Request $request)
    {
        return $this->fetchLogs($request);
    }

    public function sort(Request $request)
    {
        return $this->fetchLogs($request);
    }

    public function search(Request $request)
    {
        return $this->fetchLogs($request);
    }

    private function fetchLogs(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'timestamp'); // Mặc định sắp xếp theo 'timestamp'
        $direction = $request->input('direction', 'desc'); // Mặc định sắp xếp giảm dần

        // Lấy user_id của người dùng hiện tại
        $userId = Auth::user()->id;

        // Tạo query chỉ với log của người dùng hiện tại
        $logsQuery = UserLog::where('user_id', $userId);

        if ($query) {
            $logsQuery->where(function ($q) use ($query) {
                $q->where('action', 'LIKE', "%{$query}%")
                ->orWhere('ip_address', 'LIKE', "%{$query}%");
            });
        }

        // Đảm bảo rằng tham số sắp xếp hợp lệ để tránh lỗi SQL Injection
        $allowedSorts = ['id', 'action', 'type', 'ip_address', 'timestamp', 'status'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'timestamp';
        }

        $logs = $logsQuery->orderBy($sort, $direction)
            ->paginate(10)
            ->appends($request->only(['query', 'sort', 'direction']));

        return view('dashboard', compact('logs'));
    }
}
