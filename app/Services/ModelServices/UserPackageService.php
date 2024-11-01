<?php

namespace App\Services\ModelServices;

use App\Domains\Auth\Models\User;
use App\Exceptions\GeneralException;
use App\Models\Package;
use App\Models\ScointHistory;
use App\Models\UserPackage;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserPackageService
{
    static public function findUserPackageById($userPackageId)
    {
        return UserPackage::find($userPackageId);
    }

    static public function upgradeUserPackage($userPackageId, $timeLimit)
    {
        try {
            DB::beginTransaction();
            $userPackage = UserPackage::with('package')->with('user')->find($userPackageId);

            $user = $userPackage->user;
            $userPackage->lockForUpdate();
            // $user->lockForUpdate();


            if ($userPackage) {
                $price = $userPackage->package->price * $timeLimit;

                if ($price > $user->scoint) {
                    throw new GeneralException("Ko đủ tiền", 400);
                }


                $user->scoint = $user->scoint - $price;
                $user->save();

                // throw new Exception("Gì dó", 401);

                $currentTime = Carbon::now();
                $timeEnd = $userPackage->timeEnd;

                /*
                    Nếu $timeEnd < $currentTime (UserPackage đã hết hạn), 
                    Cập nhật lại timeLimit và timeStart, timeEnd
                */
                if ($timeEnd <= $currentTime) {
                    $userPackage->timeStart = $currentTime;
                    $userPackage->timeEnd = $currentTime->copy()->addMonths($timeLimit);
                    $userPackage->timeLimit = $timeLimit;
                    $userPackage->save();
                } else {
                    /*   
                        Ngược lại $timeEnd > $currentTime (UserPackage chưa hết hạn)
                        Cập nhật lại timeEnd
                        timeLimit mới = timeEnd mới - timeStart
                    */

                    $userPackage->timeEnd = \Carbon\Carbon::parse($userPackage->timeEnd)->addMonths($timeLimit);
                    $userPackage->timeLimit = $userPackage->timeEnd->diffInMonths($userPackage->timeStart); // Cập nhật lại timeLimit

                    $userPackage->save();
                }

                DB::commit();
                return $userPackage;
            }
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    static public function createUserPackage($userId, $packageId, $timeLimit)
    {
        try {

            DB::beginTransaction();

            $package = Package::find($packageId);
            $package->lockForUpdate();

            // dd($package);
            $user = User::find($userId);
            $user->lockForUpdate();


            $price = $package->price * $timeLimit;

            if ($price > $user->scoint) {
                throw new GeneralException("Tài khoản không đủ tiền để giao dịch", 400);
            }

            $user->scoint = $user->scoint - $price;
            $user->save();



            $timeStart = Carbon::now();
            $timeEnd = $timeStart->copy()->addMonths($timeLimit);
            $userPackage = UserPackage::createNewRecord(compact('userId', 'packageId', 'timeLimit', 'timeStart', 'timeEnd'));
            // $userPackage = new UserPackage;
            // $userPackage->userId = $userId;
            // $userPackage->packageId = $packageId;
            // $userPackage->timeLimit = $timeLimit;
            // $userPackage->timeStart = $timeStart;
            // $userPackage->timeEnd = $timeEnd;

            $userPackage->save();




            $scointHistory =  ScointHistory::createNewRecord([
                'userId' => $userId,
                'action' => ScointHistory::ACTIONS['PURCHASE'],
                'amount' => $price,
                'status' => ScointHistory::STATUSES['SUCCESS'],
                'content' => "Mua " . $package->name
            ]);

            // dd($scointHistory, $scointHistory->id, $scointHistory->getKey()); // null

            $userPackage->load('package');


            DB::commit();

            return $userPackage;
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }


    static public function getUserPackageToAddNewPaymentGatewayAccount($paymentGatewayId, $userId)
    {
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



        // dd($userPackage);

        return $userPackage ? $userPackage : null;
    }
}
