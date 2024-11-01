<?php

namespace App\Http\Requests\Frontend\PaymentGateway;

use App\Models\PaymentGatewayAccount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Helpers\PaymentGatewayHelper;
use Illuminate\Support\Str;

class AddPaymentGatewayRequest extends FormRequest
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

    //  Rule::unique('payment_gateway_accounts', 'account_no'),
    public function rules()
    {
        $paymentGateway = $this->route('paymentGateway');
        $data = PaymentGatewayHelper::createDataForAddPaymentGatewayAccount($paymentGateway);
        $inputs = $data->inputs;
        $paymentGatewayId = $paymentGateway->id;

        $userId = auth()->user()->id;



        $ruleValidates = [
            'accountNo' => [
                'required',
                'between:2,20',
                Rule::unique('payment_gateway_accounts', 'account_no')->where(function ($query) use ($paymentGatewayId, $userId) {
                    return $query->where('payment_gateway_id', $paymentGatewayId)->where('user_id', '!=', $userId);
                }),

            ],
            'password' => ['required', 'between:2,50',],
            'accountName' => 'required',
            'cookie' => 'required',
        ];

        $newRuleValidates = [];

        // Loại bỏ các key không tồn tại trong input.name
        foreach ($ruleValidates as $key => $value) {
            foreach ($inputs as $input) {
                if ($key === $input->name) {
                    $newRuleValidates[$key] = $value;
                    break;
                }
            }
        }

        // dd($newRuleValidates);


        return  $newRuleValidates;
    }


    public function attributes()
    {

        return $this->getAttributeText([
            'accountNo',
            'password',
            'accountName',
            'cookie',
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

    public function messages()
    {
        return [
            'accountNo.unique' => 'Tài khoản này đang được liên kết bởi người dùng khác',
        ];
    }
}
