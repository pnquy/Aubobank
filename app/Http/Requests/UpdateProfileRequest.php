<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'phone' => 'required|string',
            'organization' => 'required|string',
            'address' => 'required|string',
            'otp' => 'required|in:enabled,disabled',
            'anti_duplicate' => 'required|in:enabled,disabled',
        ];
    }
}
