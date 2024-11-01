<?php

use App\Domains\Auth\Http\Controllers\Frontend\Auth\ConfirmPasswordController;
use App\Domains\Auth\Http\Controllers\Frontend\Auth\DisableTwoFactorAuthenticationController;
use App\Domains\Auth\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Domains\Auth\Http\Controllers\Frontend\Auth\LoginController;
use App\Domains\Auth\Http\Controllers\Frontend\Auth\PasswordExpiredController;
use App\Domains\Auth\Http\Controllers\Frontend\Auth\RegisterController;
use App\Domains\Auth\Http\Controllers\Frontend\Auth\ResetPasswordController;
use App\Domains\Auth\Http\Controllers\Frontend\Auth\SocialController;
use App\Domains\Auth\Http\Controllers\Frontend\Auth\TwoFactorAuthenticationController;
use App\Domains\Auth\Http\Controllers\Frontend\Auth\UpdatePasswordController;
use App\Domains\Auth\Http\Controllers\Frontend\Auth\VerificationController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Access Controllers
 * All route names are prefixed with 'frontend.auth'.
 */

Route::group(['as' => 'auth.'], function () {
    Route::group(['middleware' => 'auth'], function () {
        // Authentication
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });

    Route::group(['middleware' => 'guest'], function () {
        // Authentication
        Route::get('login', [LoginController::class, 'loginView'])->name('loginView');
        Route::post('login', [LoginController::class, 'login'])->name('login');

        // Registration
        Route::get('register', [RegisterController::class, 'registerView'])->name('registerView');
        Route::post('register', [RegisterController::class, 'register'])->name('register');


        Route::get('password/forgot', [ResetPasswordController::class, 'showForgotPasswordView'])->name('forgot_password_view');
        Route::post('password/forgot', [ResetPasswordController::class, 'sendForgotPasswordEmail'])->name('send_forgot_password_email');

        // password
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetPasswordView'])->name('reset_password_view');
        // password.reset
        Route::post('password/reset', [ResetPasswordController::class, 'resetPassword'])->name('reset_password');


        // Route::get('/demo5/{token}', function ($token) {


        //     $personalAccessToken = PersonalAccessToken::findToken($token);

        //     if ($personalAccessToken) {

        //         $tokenExpiresAt = $personalAccessToken->expires_at;

        //         // dd($tokenExpiresAt->isPast());


        //         if ($tokenExpiresAt && Carbon::parse($tokenExpiresAt)->isPast()) {
        //             // Token đã hết hạn
        //             return response()->json(['message' => 'Token has expired'], 401);
        //         }
        //         // dd("reset");
        //         $password = "33";
        //         $user = $personalAccessToken->tokenable;
        //         $newPassword = Hash::make($password);

        //         $user->password = $newPassword;
        //         $user->save();
        //         Auth::logoutOtherDevices($newPassword);
        //         return redirect('/');
        //     }
        // });
    });
});