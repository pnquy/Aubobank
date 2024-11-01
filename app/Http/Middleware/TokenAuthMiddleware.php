<?php

namespace App\Http\Middleware;

use App\Utils\Formater\GeneralJsonResponseFormatter;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class TokenAuthMiddleware
{

    public function handle($request, Closure $next)
    {
        $token = $request->route('token');

        // dd($token);

        // Thực hiện xác thực token ở đây
        $personalAccessToken = PersonalAccessToken::findToken($token);


        if (!$personalAccessToken) {
            return response()->json([
                'message' => 'Token không tồn tại'
            ]);
        }

        // Kiểm tra quyền của token
        if (!$personalAccessToken->can('get_transactions')) {
            return response()->json([
                'message' => 'Token không có quyền truy cập'
            ], 403);
        }

        return $next($request);
    }
}
