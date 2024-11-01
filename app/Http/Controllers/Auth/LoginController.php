<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Services\LogService; // Import LogService
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    protected $authService;
    protected $logService; // Thêm LogService
    protected $redirectTo = '/dashboard/logs';

    public function __construct(AuthService $authService, LogService $logService)
    {
        $this->authService = $authService;
        $this->logService = $logService; // Khởi tạo LogService
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if ($this->authService->login($credentials)) {
            // Log hành động login thành công
            $this->logService->logUserAction(
                Auth::id(),
                'Login',
                'Auth',
                $request,
                'Success'
            );

            return $this->sendLoginResponse($request);
        }

        // Log hành động login thất bại
        $this->logService->logUserAction(
            null, // user_id không có nếu login thất bại
            'Login',
            'Auth',
            $request,
            'Fail'
        );

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        return redirect()->intended($this->redirectTo);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
}


