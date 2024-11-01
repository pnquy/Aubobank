<?php

namespace App\Http\Middleware;

use App\Exceptions\AuthenticateSessionException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\Middleware\AuthenticateSession as Middleware;

/**
 * Class Authenticate.
 */
class AuthenticateSession extends Middleware
{
    protected function logout($request)
    {
        $this->guard()->logoutCurrentDevice();

        $request->session()->flush();

        throw new AuthenticateSessionException('Mật khẩu đã thay đổi, vui lòng đăng nhập lại', [$this->auth->getDefaultDriver()], route('frontend.auth.loginView'));
    }
}
