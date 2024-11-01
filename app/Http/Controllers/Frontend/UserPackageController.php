<?php

namespace App\Http\Controllers\frontend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UserPackage\UpgradeUserPackageRequest;
use App\Models\PaymentGatewayAccount;
use App\Services\ModelServices\PaymentGatewayAccountService;
use App\Services\ModelServices\UserPackageService;
use App\Utils\Formater\GeneralJsonResponseFormatter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UserPackageController extends Controller
{
    private $jsonResFormater;

    public function __construct()
    {
        $this->jsonResFormater = new GeneralJsonResponseFormatter();
    }





    public function upgradeAccount(UpgradeUserPackageRequest $request)
    {

        $userPackageId = $request->input('userPackageId');
        $userId = Auth::id();


        if ($userPackageId) {
            try {
                $userPackage = UserPackageService::upgradeUserPackage($userPackageId, ...$request->only('timeLimit'));

                return redirect()->back()->with("layoutSuccessNotify", "Mua gói " . $userPackage->package->name . " Thành công");
            } catch (Exception $e) {
                // $response = $this->jsonResFormater->formatErrorResponse($e->getCode(), $e->getMessage());
                // return response()->json($response);
                return redirect()->back()->with("userHaveNotEnoughMoneyNotify", "Số tiền trong tài khoản không đủ. Bạn có muốn nạp thêm scoint");
            }
        }

        try {
            $userPackage = UserPackageService::createUserPackage($userId, ...$request->only('packageId', 'timeLimit'));
            $userPackageId = $userPackage->id;

            PaymentGatewayAccountService::autoUpdateUserPackage($userPackageId, $userId);

            return redirect()->back()->with("layoutSuccessNotify", "Mua gói " . $userPackage->package->name . " Thành công");
        } catch (GeneralException  $e) {
            return redirect()->back()->with("userHaveNotEnoughMoneyNotify", "Số tiền trong tài khoản không đủ. Bạn có muốn nạp thêm scoint");
        } catch (Throwable $e) {
            return redirect()->back()->with("layoutErrorNotify", "Đã có lỗi xảy ra trong quá trình thanh toán, vui lòng thử lại");
        }
    }
}
