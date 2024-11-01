<?php

namespace App\Http\Controllers\frontend;

use App\Domains\Auth\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\PaymentGateway\TransferMoneyRequest;
use App\Http\Requests\Frontend\PaymentGateway\UpdatePaymentGatewayRequest;
use App\Models\PaymentGateway;
use App\Models\PaymentGatewayAccount;
use App\Services\ModelServices\PaymentGatewayAccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PaymentGatewayAccountController extends Controller
{

    public function index(Request $request, PaymentGateway $paymentGateway, PaymentGatewayAccount $paymentGatewayAccount)
    {
        return redirect()->route('frontend.payment_gateway.index', ['paymentGateway' => $paymentGateway]);
    }

    public function getToken(Request $request, PaymentGateway $paymentGateway, PaymentGatewayAccount $paymentGatewayAccount)
    {

        // $userService = new UserService();
        // $user = auth()->user();
        $token = $paymentGatewayAccount->token;
        if ($token) {
            // $userService->sendPaymentGatewayAccountTokenEmail($user, $token);
            $tokenSuccessMessage = "Gửi token cho email cho tài khoản " . $paymentGatewayAccount->accountNo . " Thành công";
            return redirect()->back()->withInput()->with('layoutSuccessNotify', $tokenSuccessMessage);
        }

        return redirect()->back()->withInput()->with('layoutErrorNotify', "Token không tồn tài");
    }

    public function paymentGatewayAccountReceiveHistoryView(Request $request, PaymentGateway $paymentGateway, PaymentGatewayAccount $paymentGatewayAccount)
    {

        $transactions = [
            [
                'id' => 1,
                'code' => '123456789',
                'time' => '2022-01-01 00:00:00',
                'sender_phone_number' => '0934123456',
                'sender_name' => 'Trần Ngọc Sang 1',
                'amount' => '2139234',
                'message' => 'Trả nợ',
                'status' => 'success',
            ],
            [
                'id' => 2,
                'code' => '123456789',
                'time' => '2022-01-01 00:00:00',
                'sender_phone_number' => '0934123456',
                'sender_name' => 'Trần Ngọc Sang 1',
                'amount' => '2139234',
                'message' => 'Trả nợ',
                'status' => 'fail',
            ],
            [
                'id' => 3,
                'code' => '123456789',
                'time' => '2022-01-01 00:00:00',
                'sender_phone_number' => '0934123456',
                'sender_name' => 'Trần Ngọc Sang 1',
                'amount' => '2139234',
                'message' => 'Trả nợ',
                'status' => 'waiting',
            ],
        ];

        return view('frontend.payment_gateway.receive_history', compact("transactions"));
    }

    public function paymentGatewayAccountTransferHistoryView(Request $request, PaymentGateway $paymentGateway, PaymentGatewayAccount $paymentGatewayAccount)
    {

        $transactions = [
            [
                'id' => 1,
                'code' => '123456789',
                'time' => '2022-01-01 00:00:00',
                'receiver_phone_number' => '0934123456',
                'receiver_name' => 'Trần Ngọc Sang 1',
                'amount' => '2139234',
                'message' => 'Trả nợ',
                'status' => 'success',
            ],
            [
                'id' => 2,
                'code' => '123456789',
                'time' => '2022-01-01 00:00:00',
                'receiver_phone_number' => '0934123456',
                'receiver_name' => 'Trần Ngọc Sang 1',
                'amount' => '2139234',
                'message' => 'Trả nợ',
                'status' => 'fail',
            ],
            [
                'id' => 3,
                'code' => '123456789',
                'time' => '2022-01-01 00:00:00',
                'receiver_phone_number' => '0934123456',
                'receiver_name' => 'Trần Ngọc Sang 1',
                'amount' => '2139234',
                'message' => 'Trả nợ',
                'status' => 'waiting',
            ],
        ];

        return view('frontend.payment_gateway.transfer_history', compact("transactions"));
    }

    public function paymentGatewayAccountTransferMoneyView(Request $request, PaymentGateway $paymentGateway, PaymentGatewayAccount $paymentGatewayAccount)
    {
        return view('frontend.payment_gateway.transfer_money', compact("paymentGateway", "paymentGatewayAccount"));
    }


    public function paymentGatewayAccountTransferMoney(TransferMoneyRequest $request, PaymentGateway $paymentGateway, PaymentGatewayAccount $paymentGatewayAccount)
    {
        dd($request->all());
    }



    public function delete(Request $request, PaymentGateway $paymentGateway, PaymentGatewayAccount $paymentGatewayAccount)
    {

        // Sẽ thêm code để xóa các Table liên quan trong tương lai
        $paymentGatewayAccount->delete();
        Session::flash('notifyInfo', "Xóa thành công");

        return Redirect::back()->withInput();
    }


    public function pause(Request $request, PaymentGateway $paymentGateway, PaymentGatewayAccount $paymentGatewayAccount)
    {

        $prevPause = $paymentGatewayAccount->pause;
        $paymentGatewayAccount->updateRecord([
            'pause' => !$prevPause,
            // 'timeEnd' => '2052-01-19 00:00:00'
        ]);
        // $paymentGatewayAccount->time_end =  '2032-01-19 00:00:00';
        // $paymentGatewayAccount->timeEnd =  '2042-01-19 00:00:00';
        $paymentGatewayAccount->save();

        if ($paymentGatewayAccount->pause) {
            Session::flash('notifyInfo', "Tạm dừng thành công");
        } else {
            Session::flash('notifyInfo', "Kích hoạt thành công");
        }

        return Redirect::back()->withInput();
    }

    public function update(UpdatePaymentGatewayRequest $request, PaymentGateway $paymentGateway, PaymentGatewayAccount $paymentGatewayAccount)
    {

        PaymentGatewayAccountService::updatePaymentGatewayAccount($paymentGatewayAccount, $request->password, $request->except('_token', 'password'));
        Session::flash('layoutSuccessNotify', 'Cập nhập tài khoản thành công.');
        return Redirect::back();
    }
}
