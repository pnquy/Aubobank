<?php

namespace App\Services\ModelServices;

use App\Domains\Auth\Models\User;
use App\Exceptions\GeneralException;
use App\Models\ScointHistory;
use Illuminate\Support\Facades\DB;
use Throwable;

class ScointHistoryService
{

    public static function deposit($paymentResult, $userId)
    {

        $amount = $paymentResult->amount;

        try {
            DB::beginTransaction();

            if ($amount < 0) {
                throw new GeneralException("Số scoint phải lớn hơn 0", 400);
            }


            // Lấy thông tin người dùng và scoint hiện tại
            $user = User::lockForUpdate()->find($userId);
            $currentScoint = $user->scoint;
            // Tính toán scoint mới sau khi Nạp
            $newScoint = $currentScoint + $amount;

            // Cập nhật scoint mới cho người dùng
            $user->scoint = $newScoint;
            $user->save();


            ScointHistory::createNewRecord([
                'userId' => $userId,
                'action' => ScointHistory::ACTIONS['DEPOSIT'],
                'amount' => $amount,
                'status' => ScointHistory::STATUSES['SUCCESS'],
                'content' => $paymentResult->message
            ]);
            // Tạo lịch sử Nạp scoint

            DB::commit();
        } catch (Throwable $e) {

            DB::rollback();
            throw $e;
        }
    }

    public static function transfer($senderUserId, $receiverUserId, $amount)
    {



        try {

            if ($amount < 0) {
                throw new GeneralException("Số scoint âm'", 400);
            }
            DB::beginTransaction();

            // Lấy thông tin người dùng và scoint hiện tại
            $senderUser = User::lockForUpdate()->find($senderUserId);
            $receiverUser = User::lockForUpdate()->find($receiverUserId);



            if ($amount > $senderUser->scoint) {
                throw new GeneralException("Số coint của bạn đủ để chuyển", 400);
            }

            $newSenderUserScoint = $senderUser->scoint -  $amount;
            $newReceiverrUserScoint = $senderUser->scoint +  $amount;


            // Cập nhật scoint mới cho người dùng
            $senderUser->scoint = $newSenderUserScoint;
            $receiverUser->scoint = $newReceiverrUserScoint;


            $senderUser->save();
            $receiverUser->save();




            ScointHistory::createNewRecord([
                'userId' => $senderUser->id,
                'action' => ScointHistory::ACTIONS['TRANSFER'],
                'amount' => $amount,
                'status' => ScointHistory::STATUSES['SUCCESS'],

            ]);


            ScointHistory::createNewRecord([
                'userId' => $receiverUser->id,
                'action' => ScointHistory::ACTIONS['RECEIVE'],
                'amount' => $amount,
                'status' => ScointHistory::STATUSES['SUCCESS'],

            ]);

            DB::commit();
        } catch (Throwable $e) {

            DB::rollback();
            throw $e;
        }
    }
}
