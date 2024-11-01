<?php

namespace App\Domains\Auth\Http\Requests\Frontend\Auth;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Rules\UnusedPassword;
use Illuminate\Foundation\Http\FormRequest;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class UpdatePasswordRequest.
 */
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    private $foundUser;

    public function getFoundUser()
    {
        return $this->foundUser;
    }

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
            'phoneNumber' => [
                'required',
                function ($attribute, $value, $fail) {
                    $this->foundUser = User::where('phone_number', $value)->first();

                    if (!$this->foundUser) {
                        $fail('Tài khoản không tồn tại.');
                    }
                }
            ],
            'password' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'phoneNumber' => 'Số điện thoại',
            'password' => 'Mật khẩu'
        ];
    }
}
