<?php

namespace App\Http\Requests\Frontend\PaymentGateway;

use App\Models\PaymentGatewayAccount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Helpers\PaymentGatewayHelper;
use Illuminate\Support\Str;

class UpdatePaymentGatewayRequest extends FormRequest
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
}
