<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\BankTransLog;
use App\Models\PaymentGateway;
use App\Models\PaymentGatewayAccount;
use App\Http\Controllers\Controller;
use App\Services\MetechRequestSecurity;
use App\Utils\Formater\GeneralJsonResponseFormatter;

class BankTransLogController extends Controller
{


    private $jsonResFormater;

    public function __construct()
    {
        $this->jsonResFormater = new GeneralJsonResponseFormatter();
    }


    public function getBankTransLogs(PaymentGateway $paymentGateway, $password, $accountNo, $token)
    {

        $paymentGatewayAccount = PaymentGatewayAccount::with('paymentGateway')->where('account_no', $accountNo)->whereHas('userPackage', function ($query) {
            $query->where('time_end', '>=', Carbon::today());
        })
            ->first();

        if (!$paymentGatewayAccount) {
            return $this->jsonResFormater->formatErrorResponse(400, 'Vui lòng thêm / nâng cấp tài khoản');
        }

        $metechRequestSecurity = new MetechRequestSecurity();
        $encryptPassword = $paymentGatewayAccount?->password;
        $descryptEncryptPassword =  $metechRequestSecurity->decodeDecrypt($encryptPassword);
        // $encodedPassword = base64_decode($descryptEncryptPassword);


        if (isset($encryptPassword)  && $descryptEncryptPassword !== $password) {

            return $this->jsonResFormater->formatErrorResponse(400, 'Sai mật khẩu');
        }






        // $bankTransLogs = BankTransLogService::getAllTranslogByPaymentGatewayIdAndAccountNo($paymentGateway->id, $accountNo);
        $bankTransLogs = BankTransLog::where('account_no', $accountNo)->where('payment_gateway_id', $paymentGateway->id)->get();


        try {

            $transactions = $bankTransLogs->map(function ($transaction) {
                $formattedLog = [];
                $keys = ['transaction_id', 'amount', 'description', 'transaction_date', 'type'];
                foreach ($keys as $key) {
                    $formattedKey = Str::camel($key);
                    $formattedLog[$formattedKey] = $transaction->$key;
                }
                return $formattedLog;
            });
            return $this->jsonResFormater->formatSuccessResponseWithKey('transactions', $transactions, 'Success');
        } catch (\Throwable $th) {

            return $this->jsonResFormater->formatErrorResponse($th->getCode(), 'Token không tồn tại');
        }
    }
}
