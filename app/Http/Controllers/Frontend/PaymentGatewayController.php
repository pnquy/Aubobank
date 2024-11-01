<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\PaymentGateway\AddAccountVerifyOtpRequest;
use App\Http\Requests\Frontend\PaymentGateway\AddPaymentGatewayRequest;
use App\Http\Requests\Frontend\PaymentGateway\GetListPaymentGatewayRequest;
use App\Models\PaymentGateway;
use App\Models\PaymentGatewayAccount;
use App\Services\BankApi\AcbBankApiService;
use App\Services\ModelServices\PaymentGatewayAccountService;
use App\Services\ModelServices\UserPackageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PaymentGatewayController extends Controller
{

    public function __construct()
    {
        // Hàm kiểm tra status của branch (Tạm thời comments lại để xem các giao diện)
        $this->middleware('check_payment_gateway_status');
    }


    public function paymentGatewayListAccountView(GetListPaymentGatewayRequest $request, PaymentGateway $paymentGateway)
    {
        try {
            $userId = auth()->user()->id;
            $paymentGatewayAccounts = PaymentGatewayAccountService::getPaymentGateAccounts(
                $userId,
                $paymentGateway,
                ...$request->all()
            );

            return view('frontend.payment_gateway.list_account_view', compact("paymentGateway", "paymentGatewayAccounts"));
        } catch (\Exception $e) {
            return view('exceptions.danger');
        }
    }


    public function paymentGatewayAddAccountView(PaymentGateway $paymentGateway)
    {
        return view('frontend.payment_gateway.add_account_view', compact("paymentGateway"));
    }



    public function addPaymentGatewayAccount(AddPaymentGatewayRequest $request, PaymentGateway $paymentGateway)
    {

        $user = auth()->user();
        $brand = $paymentGateway->brand;


        $count = PaymentGatewayAccountService::countPaymentGatewayAccountByPaymentGatewayId($paymentGateway->id, $user->id);

        // Kiểm tra các gói 
        $userPackage = UserPackageService::getUserPackageToAddNewPaymentGatewayAccount($paymentGateway->id, $user->id);
        $userPackageId = $userPackage?->id;


        $paymentGatewayAccount = PaymentGatewayAccount::where('account_no', $request->accountNo)
            ->where('payment_gateway_id', $paymentGateway->id)->where('user_id', $user->id)->first();
        if ($paymentGatewayAccount) {
            if ($paymentGatewayAccount->status === PaymentGatewayAccount::STATUSES['STOP'] || $paymentGatewayAccount->status === PaymentGatewayAccount::STATUSES['SKIP']) {
                PaymentGatewayAccountService::updatePaymentGatewayAccount($paymentGatewayAccount, $request->password, $request->except('_token', 'password'));
            } else {

                Session::flash('updateAccountNotify', 'Tài khoản này đang được liên kết với gói dịch vụ Auto Bank của bạn. Bạn có chắc chắn muốn thay đổi thông tin đăng nhập?');
                Session::flash('updateAccountId', $paymentGatewayAccount->id);
                return Redirect::back()->withInput();
            }
        } else {

            // Hết hạn hoặc chưa mua
            if (!$userPackageId) {

                // Nếu ko phải lần đầu thì báo lỗi
                if ($count > 0) {
                    Session::flash('layoutErrorNotify', 'Vui lòng mua gói để thêm tải khoản');
                    return Redirect::back()->withInput();
                }
            }
            $newPaymentGatewayAccount = PaymentGatewayAccountService::createPaymentGateAccount($paymentGateway->id, $user->id, $request->accountNo, $request->password, $userPackageId, $request->except('_token', 'password'));
        }

        // CHUYỂN SANG BƯỚC OTP

        $brand = $paymentGateway->brand;
        extract(PaymentGateway::BRANDS);

        switch ($brand) {
            case $MOMO:
            case $ZALOPAY:

                Session::flash('addAccountStep', 'otp');
                Session::flash('layoutSuccessNotify', 'Thêm tài khoản thành công.');
                return Redirect::back()->withInput();
            default:
                break;
        }



        Session::flash('layoutSuccessNotify', 'Thêm tài khoản thành công.');
        return Redirect::back();
    }

    public function addPaymentGatewayAccountVerifyOtp(Request $request, PaymentGateway $paymentGateway)
    {
        $validator = Validator::make($request->all(), (new AddAccountVerifyOtpRequest())->rules());

        if ($validator->fails()) {
            Session::flash('addAccountStep', 'otp');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Session::flash('layoutSuccessNotify', 'Xác thực OTP thành công.');
        return redirect()->back();
    }
}
