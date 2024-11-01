<?php

namespace App\Http\Requests\Frontend\UserPackage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpgradeUserPackageRequest extends FormRequest
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
            'packageId' => [
                'required',
            ],
            'timeLimit' => [
                'required',
                'integer',
                'between:1,12',
            ],
            'userPackage' => '',
        ];
    }
}
