<?php
// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLog;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {
        // Xử lý thay đổi mật khẩu

        // Ghi log
        UserLog::create([
            'user_id' => auth()->id(),
            'action' => 'Change Password',
            'type' => 'Security',
            'ip_address' => $request->ip(),
            'timestamp' => now(),
            'status' => 'Success',
        ]);

        // Trả về response
    }

    public function logout()
    {
        // Xử lý đăng xuất

        // Ghi log
        UserLog::create([
            'user_id' => auth()->id(),
            'action' => 'Logout',
            'type' => 'Session',
            'ip_address' => request()->ip(),
            'timestamp' => now(),
            'status' => 'Success',
        ]);

        // Trả về response
    }
    public function showProfile()
    {
        // Lấy logs của người dùng hiện tại
        $logs = UserLog::where('user_id', auth()->id())->get();

        // Truyền logs vào view
        return view('dashboard', compact('logs'));
    }

    // Tương tự cho các hành động khác
}
