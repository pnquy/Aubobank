<?php
namespace App\Services;

use App\Models\UserLog;
use Illuminate\Http\Request;

class LogService
{
    public function logUserAction(int $userId, string $action, string $type, Request $request, string $status): void
    {
        UserLog::create([
            'user_id'    => $userId,
            'action'     => $action,
            'type'       => $type,
            'ip_address' => $request->ip(),
            'timestamp'  => now(),
            'status'     => $status,
        ]);
    }
}
