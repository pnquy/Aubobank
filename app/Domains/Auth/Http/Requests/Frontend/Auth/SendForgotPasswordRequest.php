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
class SendForgotPasswordRequest extends FormRequest
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
            'email' => [
                'required',
                Rule::exists(User::class, 'email'),
            ],
        ];
    }


    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email.',
            'email.exists' => 'Email không tồn tại.',
        ];
    }



    // public function withValidator($validator)
    // {
    //     if ($validator->fails()) {
    //         $errors = $validator->errors();
    //         return redirect()
    //             ->back()
    //             ->withInput()
    //             ->with("layoutErrorNotify", $errors);
    //     }
    // }
}
