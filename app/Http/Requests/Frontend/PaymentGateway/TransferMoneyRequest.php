<?php

namespace App\Http\Requests\Frontend\PaymentGateway;

use App\Helpers\PaymentGatewayHelper;
use App\Models\PaymentGatewayAccount;
use Illuminate\Foundation\Http\FormRequest;


class TransferMoneyRequest extends FormRequest
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
            'phoneNumber' => [
                'required',
                'regex:/^(0\d{9}|84\d{10})$/',

            ],
            'receivedPhoneNumber' => [
                'required',
                'regex:/^(0\d{9}|84\d{10})$/',

            ],
            'amountMoney' => [
                'required',
                'numeric',
                'min:100',

            ],
            'message' => [
                'max:160',
            ],
            'password' => [
                'required',
                'min:2',
                'max:6',
            ],
            'token' => [
                'required',
                'min:5',
                'max:100',
            ],
        ];
    }


    public function attributes()
    {
        return [
            'phoneNumber' => 'Số điện thoại',
            'receivedPhoneNumber' => 'Số điện thoại người nhận',
            'amountMoney' => 'Số tiền',
            'message' => 'Tin nhắn',
            'password' => 'Mật khẩu',
            'token' => 'Token',
        ];
    }
}
