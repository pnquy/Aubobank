<?php

namespace App\Http\Requests\Frontend\PaymentGateway;

use App\Helpers\PaymentGatewayHelper;
use App\Models\PaymentGatewayAccount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AddAccountVerifyOtpRequest extends FormRequest
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
            'accountNo' => [
                'required'
            ],
            'password' => ['required', 'between:2,50',],
            'otp' => ['required', 'regex:/^[0-9]+$/u', 'size:4'],
        ];
    }



    public function withValidator($validator)
    {
        if ($validator->fails()) {
            Session::flash('addAccountStep', 'otp');

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $validator->errors());
        }
    }



    public function attributes()
    {

        return $this->getAttributeText([
            'accountNo',
            'password',
            'otp',
        ]);
    }

    private function getAttributeText($labelKeys)
    {

        $paymentGateway = $this->route('paymentGateway');
        $data = PaymentGatewayHelper::createDataForAddPaymentGatewayAccount($paymentGateway);
        $paymentGatewayType = $data->paymentGatewayType;


        $attributes = [];
        foreach ($labelKeys as $labelKey) {
            $attributes[$labelKey] = __(Str::snake('payment_gateway.add.form.' . $paymentGatewayType . '.' . $labelKey . '.label'), ['app_name' =>  $paymentGateway->brand]);
        }


        return $attributes;
    }
}