<?php

namespace App\Http\Requests\Frontend\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdatePasswordRequest extends FormRequest
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
            'currentPassword' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:50',
                // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                'confirmed'
            ],

        ];
    }

    public function attributes()
    {
        return [
            'currentPassword' => 'Mật khẩu hiện tại',
            'password' => 'Mật khẩu mới',
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'Trường :attribute phải chứa cả chữ và số, từ 8-50 kí tự'
        ];
    }


    public function validationData()
    {
        $data = $this->all();
        $data['password_confirmation'] = $this->input('confirmPassword');
        $this->replace($data);
        return $data;
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {

            return redirect()
                ->back()
                ->with('errors', $validator->errors());
        }
    }
}
