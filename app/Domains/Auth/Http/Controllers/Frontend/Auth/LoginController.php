<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Events\User\UserLoggedIn;
use App\Domains\Auth\Http\Requests\Frontend\Auth\LoginRequest;
use App\Domains\Auth\Services\UserService;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Laravel\Sanctum\PersonalAccessToken;
use Throwable;

/**
 * Class LoginController.
 */
class LoginController
{
    private UserService $userService;


    public function  __construct()
    {
        $this->userService = new UserService();
    }

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(homeRoute());
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginView()
    {
        return view('frontend.auth.login');
    }


    public function login(LoginRequest $request)
    {

        $foundUser = $request->getFoundUser();

        // if ($foundUser->isLocked == true) {
        //     return redirect()->back()->withInput()->with("layoutErrorNotify", "Tài khoản của bạn đang bị khóa");
        // }

        if ($foundUser->loginAttempt >= 5) {
            try {
                $this->userService->sendUnlockEmail($foundUser->email);
                return redirect()->back()->withInput()->with("layoutErrorNotify", "Tài khoản của bạn để bị tạm khóa vì nhập sai một khẩu nhiều lần. Vui lòng kiểm tra email để kích hoạt lại tài khoản");
            } catch (Throwable $e) {
                return $e;
            }
        }

        $credentials = [
            'phone_number' => $request->input('phoneNumber'),
            'password' => $request->input('password'),
        ];



        if (Auth::attempt($credentials)) {
            $foundUser->loginAttempts = 0;
            $accessToken = $foundUser->accessToken;

            if (!$accessToken || !PersonalAccessToken::findToken($accessToken)) {
                // Tạo mới accessToken nếu không tồn tại hoặc không tìm thấy trong danh sách tokens
                $accessToken = $foundUser->createToken('API Token', ['get_transactions'])->plainTextToken;
                $foundUser->accessToken = $accessToken;
            }

            $foundUser->save();


            return redirect('/')->with('layoutSuccessNotify', 'Đăng nhập thành công');
        } else {
            $currentLoginAttempts = $foundUser->loginAttempts  + 1;
            $foundUser->loginAttempts = $currentLoginAttempts;

            if ($currentLoginAttempts >= 5) {
                $foundUser->isLocked = true;
                $foundUser->save();



                try {
                    $this->userService->sendUnlockEmail($foundUser->email);
                    return redirect()->back()->withInput()->with("layoutErrorNotify", "Tài khoản của bạn để bị tạm khóa vì nhập sai một khẩu nhiều lần. Vui lòng kiểm tra email để kích hoạt lại tài khoản");
                } catch (Throwable $e) {
                    return $e;
                }
            } else {
                $countCanLoginAgain = 5 - $currentLoginAttempts;
                $foundUser->save();
                return redirect()->back()->withInput()->with("layoutErrorNotify", "Mật khẩu không chính xác, bạn còn " . $countCanLoginAgain . " lần thử");
            }
        }


        if ($credentials)
            return redirect('/')->with('layoutSuccessNotify', 'Đăng nhập thành công');


        return redirect()->back()->with("layoutErrorNotify", "Sai số điện thoại hoặc mật khẩu");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
