<?php

namespace App\Domains\Auth\Http\Requests\Frontend\Auth;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Rules\UnusedPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class UpdatePasswordRequest.
 */
class ResetPasswordRequest extends FormRequest
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
            'token' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:50',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'confirmed'
            ],

        ];
    }

    public function attributes()
    {
        return [
            'password' => 'Mật khẩu',
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'Trường :attribute phải chứa cả chữ và số'
        ];
    }


    public function validationData()
    {
        $data = $this->all();
        $data['password_confirmation'] = $this->input('confirmPassword');
        $this->replace($data);
        return $data;
    }
}
