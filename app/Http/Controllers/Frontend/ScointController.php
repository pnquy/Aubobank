<?php

namespace App\Http\Controllers\Frontend;

use App\Utils\JsonResponseFormatter;
use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;

use App\Models\ScointHistory;
use App\Services\ModelServices\ScointHistoryService;
use App\Utils\Formater\GeneralJsonResponseFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ScointController extends Controller
{

    private $jsonResFormater;

    public function __construct()
    {
        $this->jsonResFormater = new GeneralJsonResponseFormatter();
    }


    public function index()
    {
    }

    public function transferView()
    {
        return view("frontend.scoint.transfer");
    }


    public function historyView()
    {
        return view("frontend.scoint.history");
    }

    public function depositView()
    {
        return view("frontend.scoint.deposit");
    }



    public function deposit(Request $request)
    {

        $paymentResult = (object) [
            'amount' => 10,
            'result' => true,
            'message' => "Nạp tiền"
        ];

        $userId = auth()->id();

        $amount = $paymentResult->amount;


        try {
            $deposit = ScointHistoryService::deposit($paymentResult, $userId);
            return redirect()->back()->with("layoutSuccessNotify", "Nạp coint thành công");
        } catch (Throwable  $e) {
            return redirect()->back()->with("layoutErrorNotify", $e->message);
        };
    }

    public function transfer(Request $request)
    {

        $senderUserId = auth()->id();
        $receiverUserId = '183f86fb-bcc7-46b4-ade2-2634fdf4e7b1';
        $amount = 600000000000;


        try {
            $transfer = ScointHistoryService::transfer(
                $senderUserId,
                $receiverUserId,
                $amount,
            );

            return redirect()->back()->with("layoutSuccessNotify", "Chuyển coint thành công");
        } catch (Throwable  $e) {
            return redirect()->back()->with("layoutErrorNotify", $e->message);
        };
    }
}
