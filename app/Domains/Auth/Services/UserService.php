<?php

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\User\UserCreated;
use App\Domains\Auth\Events\User\UserDeleted;
use App\Domains\Auth\Events\User\UserDestroyed;
use App\Domains\Auth\Events\User\UserRestored;
use App\Domains\Auth\Events\User\UserStatusChanged;
use App\Domains\Auth\Events\User\UserUpdated;
use App\Domains\Auth\Models\User;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService.
 */
class UserService
{
    public function sendForgotPasswordEmail($userOrEmailOrPhoneNumber)
    {
        $user = null;
        // Kiểm tra kiểu dữ liệu của tham số
        if ($userOrEmailOrPhoneNumber instanceof User) {
            $user = $userOrEmailOrPhoneNumber;
        } elseif (filter_var($userOrEmailOrPhoneNumber, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $userOrEmailOrPhoneNumber)->first();
        } elseif (is_numeric($userOrEmailOrPhoneNumber)) {
            $user = User::where('phone_number', $userOrEmailOrPhoneNumber)->first();
        } else {
            return null;
        }

        // Tiếp tục xử lý gửi email reset mật khẩu
        if ($user) {
            $resetPasswordToken = $user->createToken('reset_password', ['reset_password']);

            $expiration = now()->addMinutes(5);

            // Kiểm tra xem token có tồn tại không
            if ($resetPasswordToken->accessToken) {
                $resetPasswordToken->accessToken->expires_at = $expiration;
                $resetPasswordToken->accessToken->save();
            }



            $user->sendPasswordResetNotification($resetPasswordToken->plainTextToken);
        }
    }

    public function sendUnlockEmail($userOrEmailOrPhoneNumber)
    {
        $user = null;
        // Kiểm tra kiểu dữ liệu của tham số
        if ($userOrEmailOrPhoneNumber instanceof User) {
            $user = $userOrEmailOrPhoneNumber;
        } elseif (filter_var($userOrEmailOrPhoneNumber, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $userOrEmailOrPhoneNumber)->first();
        } elseif (is_numeric($userOrEmailOrPhoneNumber)) {
            $user = User::where('phone_number', $userOrEmailOrPhoneNumber)->first();
        } else {
            return null;
        }

        // Tiếp tục xử lý gửi email reset mật khẩu
        if ($user) {
            $resetPasswordToken = $user->createToken('reset_password', ['reset_password']);

            $user->sendEmailUnlockNotification($resetPasswordToken->plainTextToken);
        }
    }

    public function sendPaymentGatewayAccountTokenEmail($userOrEmailOrPhoneNumber, $token)
    {
        $user = null;
        // Kiểm tra kiểu dữ liệu của tham số
        if ($userOrEmailOrPhoneNumber instanceof User) {
            $user = $userOrEmailOrPhoneNumber;
        } elseif (filter_var($userOrEmailOrPhoneNumber, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $userOrEmailOrPhoneNumber)->first();
        } elseif (is_numeric($userOrEmailOrPhoneNumber)) {
            $user = User::where('phone_number', $userOrEmailOrPhoneNumber)->first();
        } else {
            return null;
        }

        // Tiếp tục xử lý gửi email reset mật khẩu
        if ($user) {
            $user->sendPaymentGatewayAccountTokenEmail($token);
        }
    }
}
