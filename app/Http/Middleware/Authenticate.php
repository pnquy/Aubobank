<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

/**
 * Class Authenticate.
 */
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

        // return $request->expectsJson() ? null : route('frontend.auth.loginView');

        if (!$request->expectsJson()) {
            return route('frontend.auth.loginView');
        }
        return null;
    }
}
