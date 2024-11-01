<?php

namespace App\Http\Requests\Frontend\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'firstName' => [
                'string',
                'between:1,50',
                'filled',
            ],
            'lastName' => [
                'string',
                'between:1,50',
                'filled',
            ],
            'otpVerifyLoginPause' => [
                'nullable',
                'boolean',
            ],
            'telegramNotificationPause' => [
                'nullable',
                'boolean',
            ],
            'company' => [
                'nullable',
                'string',
                'between:2,50',
            ],
            'address' => [
                'nullable',
                'string',
                'between:2,50',
            ],
            'telegramGroupId' => [
                'nullable',
                'string',

            ],
            'telegramtoken' => [
                'nullable',
                'string',

            ],
        ];
    }


    public function attributes()
    {
        return [
            'firstName' => "Tên",
            'lastName' => "Họ",
            'otpVerifyLoginPause' => "Bật tắt tính năng OTP Xác thực đăng nhập",
            'telegramNotificationPause' => "Bật tắt tính năng thông báo Telegram",
            'company' => "Tên tổ chức",
            'address' => "Địa chỉ",
            'telegramGroupId' => "Telegram Group ID",
            'telegramtoken' => "Telegram Token",
        ];
    }
}