<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutoLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // dd("Auto login");

        if (!Auth::check()) {
            $credentials = [
                'email' => 'user1@gmail.com',
                'password' => '111111',
            ];

            Auth::attempt($credentials);

            // if (Auth::attempt($credentials)) {
            //     dd("Thành công");
            // } else {
            //     dd("Thất bại");
            // }
        }

        return $next($request);
    }
}