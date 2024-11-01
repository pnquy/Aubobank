<?php

namespace App\Http\Controllers;

use App\Models\UserLog;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\DeactivateAccountRequest;
use App\Services\UserService;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\UpdateAvatarRequest;

class ProfileController extends Controller
{
    protected UserService $userService;
    protected LogService $logService;

    public function __construct(UserService $userService, LogService $logService)
    {
        $this->userService = $userService;
        $this->logService = $logService;
    }

    /**
     * Update the user's avatar.
     */
    public function updateAvatar(UpdateAvatarRequest $request): RedirectResponse
    {
        try {
            $this->userService->updateUserAvatar($request);
            $this->logService->logUserAction(auth()->id(), 'Update Avatar', 'Profile Update', $request, 'Success');

            return redirect()->back()->with('success', 'Ảnh đại diện đã được cập nhật!');
        } catch (\Exception $e) {
            $this->logService->logUserAction(auth()->id(), 'Update Avatar', 'Profile Update', $request, 'Fail');

            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra khi cập nhật ảnh đại diện.']);
        }
    }

    /**
     * Show the profile edit form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(UpdateProfileRequest $request): RedirectResponse
    {
        try {
            $user = auth()->user();
            $this->userService->updateProfile($user, $request->validated());

            $this->logService->logUserAction(auth()->id(), 'Update Profile', 'Profile Update', $request, 'Success');

            return redirect()->back()->with('update_message', 'Thông tin đã được cập nhật thành công.');
        } catch (\Exception $e) {
            $this->logService->logUserAction(auth()->id(), 'Update Profile', 'Profile Update', $request, 'Fail');

            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra khi cập nhật thông tin.']);
        }
    }

    /**
     * Show the profile information form.
     */
    public function showProfile(): View
    {
        $user = auth()->user(); // Get the authenticated user
        return view('profile.partials.update-profile-information-form', compact('user'));
    }

    /**
     * Show the user's activity logs.
     */
    public function showActivityLogs(Request $request): View
    {
        $userId = auth()->id();

        // Truy vấn các bản ghi nhật ký hoạt động của người dùng hiện tại với phân trang
        $logs = UserLog::where('user_id', $userId)
            ->orderBy('timestamp', 'desc') // Sắp xếp theo thời gian giảm dần
            ->paginate(3); // 3 bản ghi mỗi trang. Bạn có thể điều chỉnh số lượng này

        return view('dashboard', compact('logs'));
    }

    /**
     * Show banking information profile.
     */
    public function showInfoProfile(): View
    {
        $userId = auth()->id();
        $bankingInfo = DB::table('deadline_banking')->where('id', $userId)->first();

        return view('dashboard', compact('bankingInfo'));
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $success = $this->userService->changePassword($request);

        if ($success) {
            $this->logService->logUserAction(auth()->id(), 'Change Password', 'Security', $request, 'Success');
            return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công.');
        } else {
            $this->logService->logUserAction(auth()->id(), 'Change Password', 'Security', $request, 'Fail');
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác.']);
        }
    }

    /**
     * Deactivate the user's account.
     */
    public function deactivateAccount(DeactivateAccountRequest $request): RedirectResponse
    {
        try {
            $this->userService->deactivateAccount();

            if (auth()->check()) {
                $this->logService->logUserAction(auth()->id(), 'Deactivate Account', 'Security', $request, 'Success');
            }

            return redirect()->route('login')->with('success', 'Tài khoản đã bị hủy kích hoạt.');
        } catch (\Exception $e) {
            if (auth()->check()) {
                $this->logService->logUserAction(auth()->id(), 'Deactivate Account', 'Security', $request, 'Fail');
            }

            return redirect()->route('login')->with('error', 'Có lỗi xảy ra khi hủy kích hoạt tài khoản.');
        }
    }
}
