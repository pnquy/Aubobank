<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\LogService; // Import LogService
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    protected $logService; // Khai báo LogService

    public function __construct(LogService $logService) // Thêm LogService vào constructor
    {
        $this->logService = $logService;
    }

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Xác thực người dùng
        $this->authenticateUser($request);

        // Kiểm tra trạng thái 'active' của tài khoản
        if ($this->isAccountInactive(Auth::user())) {
            return $this->handleInactiveAccount();
        }

        // Ghi log đăng nhập thành công với ID người dùng hợp lệ
        $this->logUserAction('Login', $request, 'Success');

        // Tái sinh session
        $this->regenerateSession($request);

        return redirect()->intended(route('dashboard.logs.index', absolute: false));
    }

    /**
     * Xác thực người dùng.
     */
    protected function authenticateUser(LoginRequest $request): void
    {
        $request->authenticate();
    }

    /**
     * Kiểm tra xem tài khoản có bị vô hiệu hóa (active = 0) không.
     */
    protected function isAccountInactive($user): bool
    {
        return $user->active == 0;
    }

    /**
     * Xử lý trường hợp tài khoản bị vô hiệu hóa.
     */
    protected function handleInactiveAccount(): RedirectResponse
    {
        Auth::logout(); // Đăng xuất ngay nếu không được phép
        return redirect('/login')->withErrors(['email' => 'Tài khoản của bạn đã bị vô hiệu hóa.']);
    }

    /**
     * Ghi log hành động của người dùng.
     */
    protected function logUserAction(string $action, Request $request, string $status): void
    {
        $userId = Auth::id();

        // Chỉ ghi log nếu có ID người dùng hợp lệ
        if ($userId) {
            $this->logService->logUserAction(
                $userId,
                $action,
                'Auth',
                $request,
                $status
            );
        }
    }

    /**
     * Tái sinh session cho người dùng.
     */
    protected function regenerateSession(Request $request): void
    {
        $request->session()->regenerate();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $userId = Auth::id(); // Lưu ID người dùng trước khi đăng xuất

        Auth::guard('web')->logout();

        // Ghi log khi đăng xuất, sử dụng ID đã lưu
        if ($userId) {
            $this->logService->logUserAction(
                $userId,
                'Logout',
                'Auth',
                $request,
                'Success'
            );
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
