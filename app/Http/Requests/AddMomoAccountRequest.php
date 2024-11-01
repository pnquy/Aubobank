<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMomoAccountRequest extends FormRequest
{
    public function authorize()
    {
        // Chỉ cho phép nếu người dùng đăng nhập
        return auth()->check();
    }

    public function rules()
    {
        return [
            'phone' => 'required|digits_between:10,11',
            'pass' => 'required|string|min:5|max:6',
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'Số điện thoại MoMo là bắt buộc.',
            'phone.digits_between' => 'Số điện thoại phải có từ 10 đến 11 chữ số.',
            'pass.required' => 'Mật khẩu MoMo là bắt buộc.',
            'pass.min' => 'Mật khẩu phải có ít nhất 5 ký tự.',
            'pass.max' => 'Mật khẩu không được vượt quá 6 ký tự.',
        ];
    }
}

