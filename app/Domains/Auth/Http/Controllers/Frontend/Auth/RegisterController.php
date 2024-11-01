<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Http\Requests\Frontend\Auth\RegisterRequest;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;
use App\Rules\Captcha;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Ramsey\Uuid\Uuid;
use Route;

/**
 * Class RegisterController.
 */
class RegisterController
{
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registerView()
    {
        return view('frontend.auth.register');
    }


    public function register(RegisterRequest $request)
    {


        $newUser = User::create($request->only([
            'email', 'phoneNumber', 'password', 'lastName', 'firstName'
        ]));

        if ($newUser)
            return redirect()->back()->with('layoutSuccessNotify', 'Đăng ký thành công');


        return redirect()->back()->withInput()->with('layoutErrorNotify', 'Đăng ký thất bại');
    }
}
