<?php

namespace App\Services\ModelServices;

use Carbon\Carbon;
use App\Models\PaymentGatewayAccount;
use App\Models\UserPackage;
use App\Services\MetechRequestSecurity;

use Illuminate\Support\Facades\DB;



class PaymentGatewayAccountService
{
    static public function getPaymentGateAccounts($userId, $paymentGateway, $search, $sortBy = "account_no", $sortOrder = "DESC")
    {
        // dd($search, $sortBy, $sortOrder);
        $query = PaymentGatewayAccount::with('userPackage.package')->where('payment_gateway_id', $paymentGateway->id)->where('user_id', $userId)
            ->where('account_no', 'like', '%' . $search . '%');


        if (!empty($sortBy)) {
            $sort = "$sortBy $sortOrder";
            $query->orderByRaw($sort);
        }


        $paymentGatewayAccounts = $query->paginate(5);
        return $paymentGatewayAccounts;
    }

    static public function createPaymentGateAccount($paymentGatewayId, $userId, $accountNo, $password, $userPackageId = null, $accountData)
    {
        // dd($accountData);
        // dd($paymentGatewayId, $userId, $accountNo, $password, $data = null, $userPackageId);

        $metechRequestSecurity = new  MetechRequestSecurity();
        $encryptPassword =  $metechRequestSecurity->encrypt($password);

        // dd($paymentGatewayId, $userId, $accountNo, $password);
        $paymentGatewayAccount = PaymentGatewayAccount::createNewRecord([
            'accountNo' => $accountNo,
            'password' => $encryptPassword,
            'accountData' =>  json_encode($accountData),
            'paymentGatewayId' => $paymentGatewayId,
            'userId' => $userId,
            'userPackageId' => $userPackageId
        ]);
        return $paymentGatewayAccount;
    }


    static public function updatePaymentGatewayAccount($paymentGatewayAccount, $password, $accountData)
    {
        // dd($accountData);
        // dd($paymentGatewayId, $userId, $accountNo, $password, $data = null, $userPackageId);


        $metechRequestSecurity = new  MetechRequestSecurity();
        $encryptPassword =  $metechRequestSecurity->encrypt($password);

        // dd($paymentGatewayId, $userId, $accountNo, $password);
        $paymentGatewayAccount->updateRecord([
            'password' => $encryptPassword,
            'accountData' =>  json_encode($accountData),
            'status' => PaymentGatewayAccount::STATUSES['INIT'],
            'token' => null
        ]);
        $paymentGatewayAccount->save();
        return $paymentGatewayAccount;
    }

    // Dựa vào userPackageId mới, thêm nó vào paymentGatewayAccount chưa có userPackage
    static public function autoUpdateUserPackage($userPackageId, $userId)
    {

        $userPackage = UserPackage::with('package.paymentGatewayPackages')
            ->find($userPackageId);

        // dd($userPackage);

        /*
            - Tìm số lượng cổng được phép của mỗi package
            
            => for $userPackage->package->paymentGatewayPackages 
            
            Với mỗi paymentGatewayPackage, ta sẽ lấy
            + Lấy usageAccountLimit của từng cái 
            + Lấy paymentGatewayId mỗi cái
            + Từ paymentGatewayId và userId, lấy các paymentGatewayAccounts (mà UserPackage đã hết hạn hoặc ko có UserPackage) (Chỉ lấy tối đa usageAccountLimit paymentGatewayAccount ) và lặp qua 
                Với mỗi paymentGatewayAccount (ứng với paymentGatewayId và userId)
                * Cặp nhập lại userPackageId theo userPackageId

            
        */

        foreach ($userPackage->package->paymentGatewayPackages as $paymentGatewayPackage) {
            $usageAccountLimit = $paymentGatewayPackage->usageAccountLimit;
            $paymentGatewayId = $paymentGatewayPackage->paymentGatewayId;

            $currentDateTime = Carbon::now();

            $paymentGatewayAccounts = PaymentGatewayAccount::where('payment_gateway_id', $paymentGatewayId)
                ->where(function ($query) use ($userId, $userPackageId, $currentDateTime) {
                    $query->where('user_id', $userId)
                        ->where(function ($subquery) use ($userPackageId, $currentDateTime) {
                            $subquery->whereNull('user_package_id')
                                ->orWhere(function ($subsubquery) use ($userPackageId, $currentDateTime) {
                                    $subsubquery->where('user_package_id', $userPackageId)
                                        ->whereHas('userPackage', function ($subsubsubquery) use ($currentDateTime) {
                                            $subsubsubquery->where('time_end', '<', $currentDateTime);
                                        });
                                });
                        });
                })
                ->limit($usageAccountLimit)
                ->get();



            foreach ($paymentGatewayAccounts as $paymentGatewayAccount) {
                $paymentGatewayAccount->user_package_id = $userPackageId;
                $paymentGatewayAccount->save();
            }
        }
    }


    static public function autoUpdateUserPackageByPaymentGatewayAccountId($paymentGatewayAccountId, $userId)
    {

        $currentDateTime = Carbon::now();
        $paymentGatewayAccount = PaymentGatewayAccount::with('userPackage')->with('paymentGateway')->find($paymentGatewayAccountId);


        if ($paymentGatewayAccount->userPackageId !== null) {
            if ($paymentGatewayAccount->userPackage->timeEnd >= $currentDateTime) {
                return  $paymentGatewayAccount;
            }
        }

        $paymentGatewayId = $paymentGatewayAccount->paymentGatewayId;


        // dd($paymentGatewayId, $userId);
        $userPackage = UserPackage::with('package.paymentGatewayPackages')
            ->where('user_id', $userId)
            ->whereHas('package.paymentGatewayPackages', function ($query) use ($paymentGatewayId) {
                $query->where('payment_gateway_id', $paymentGatewayId)
                    ->where('usage_account_limit', '>', function ($subquery) use ($paymentGatewayId) {
                        $subquery->select(DB::raw('COUNT(*)'))
                            ->from('payment_gateway_accounts')
                            ->whereColumn('user_packages.id', 'payment_gateway_accounts.user_package_id')
                            ->where('payment_gateway_accounts.payment_gateway_id', $paymentGatewayId);
                    })
                    ->whereColumn('time_end', '>=', DB::raw('NOW()'));
            })
            ->first();

        if ($userPackage) {
            dd("Đủ");
            $paymentGatewayAccount->userPackageId = $userPackage->id;
            $paymentGatewayAccount->save();
        } else {
            dd("KO đủ tài khoản");
        }



        return $paymentGatewayAccount;
    }


    public static function countPaymentGatewayAccountByPaymentGatewayId($paymentGatewayId, $userId)
    {
        $count = PaymentGatewayAccount::where('payment_gateway_id', $paymentGatewayId)
            ->where('user_id', $userId)
            ->count();

        return $count;
    }
}