<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Http\Requests\Frontend\Auth\ResetPasswordRequest;
use App\Domains\Auth\Http\Requests\Frontend\Auth\SendForgotPasswordRequest;
use App\Domains\Auth\Rules\UnusedPassword;
use App\Domains\Auth\Services\UserService;
use App\Providers\RouteServiceProvider;
use App\Utils\Formater\GeneralJsonResponseFormatter;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Class ResetPasswordController.
 */
class ResetPasswordController
{

    private UserService $userService;



    public function  __construct()
    {
        $this->userService = new UserService();
    }

    public function showResetPasswordView(Request $request, $token = null)
    {
        return view('frontend.auth.reset_password')
            ->withToken($token)
            ->withEmail($request->email);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {



        $personalAccessToken = PersonalAccessToken::findToken($request->token);
        if ($personalAccessToken) {

            $tokenExpiresAt = $personalAccessToken->expires_at;


            if ($tokenExpiresAt && Carbon::parse($tokenExpiresAt)->isPast()) {
                return redirect()->back()->withInput()->with('layoutErrorNotify', 'Mã xác nhận đã hết hạn. Vui lòng thực hiện lại');
            }




            $user = $personalAccessToken->tokenable;
            $newPassword = Hash::make($request->password);

            if ($user) {
                $user->password = $newPassword;
                $user->save();

                $personalAccessTokens = PersonalAccessToken::where('tokenable_id', $user->id)
                    ->where('tokenable_type', get_class($user))
                    ->get();

                // Xóa từng Personal Access Token
                foreach ($personalAccessTokens as $personalAccessToken) {
                    $personalAccessToken->delete();
                }

                Auth::logoutOtherDevices($newPassword);



                return redirect('/')->with('layoutSuccessNotify', 'Đổi mật khẩu thành công');
            }
            return redirect()->back()->withInput()->with('layoutErrorNotify', 'Đã có lỗi vui lòng thử lại');
        }


        return redirect()->back()->withInput()->with('layoutErrorNotify', 'Mã xác nhận không đúng');
    }



    public function showForgotPasswordView(Request $request)
    {
        return view('frontend.auth.forgot_password');
    }

    public function sendForgotPasswordEmail(SendForgotPasswordRequest $request)
    {
        $email = $request->email;
        $this->userService->sendForgotPasswordEmail($email);
        return redirect()->back()->with('layoutSuccessNotify', 'Vui lòng kiểm tra email để lấy mã xác nhận');
    }
}
