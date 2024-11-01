<?php

namespace App\Http\Requests\Frontend\PaymentGateway;

use App\Models\PaymentGatewayAccount;
use Doctrine\DBAL\Types\JsonType;
use Illuminate\Support\Str;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Schema;

class GetListPaymentGatewayRequest extends FormRequest
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
            //
        ];
    }

    protected function prepareForValidation()
    {

        $sortBy = $this->input('sortBy', null);

        // Nếu sortBy tồn tại (khác null)
        if (isset($sortBy)) {
            // Lấy dạng snake key của sortBy
            $snakeCaseSortBy = Str::snake($sortBy);

            // Kiểm tra dạng snakeCaseSortBy của nó có tồn tại trong table ko

            if (Schema::hasColumn(PaymentGatewayAccount::getTableName(), $snakeCaseSortBy)) {
                // Nếu có
                $sortBy = $snakeCaseSortBy;
            } else {
                // Nếu ko, mặc định nó là 1 key trong account_data
                // Tạm thời bỏ chức năng sort theo json column
                // $sortBy = "account_data->'$.$sortBy'";
                $sortBy = "";
            }
        }



        // dd($snakeCaseSortBy, $sortSubKeyBy);
        $this->replace([
            'sortBy' => $sortBy,
            'sortOrder' => $this->input('sortOrder', 'ASC'),
            'search' => $this->input('search', ''),
        ]);
    }
}
