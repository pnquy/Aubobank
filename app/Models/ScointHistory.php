<?php

namespace App\Models;

use App\Domains\Auth\Models\User;

class ScointHistory extends BaseModel
{
    protected $table = 'scoint_historys';

    const STATUSES = [
        "SUCCESS" => "success",
        "FAILURE" => "failure",
        "PROCESSING" => "processing",
    ];

    const ACTIONS = [
        "DEPOSIT" => "deposit",
        "PURCHASE" => "purchase",
        "TRANSFER" => "transfer",
        "RECEIVE" => "receive",
    ];

    protected $fillable = [
        "transaction_id",
        "user_id",
        "action",
        "status",
        "amount",
        "content",
        "package_id",
        "other_user_id",
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }


    public function otherUser()
    {
        return $this->belongsTo(User::class, 'userId');
    }


    public function package()
    {
        return $this->belongsTo(Package::class, 'packageId');
    }
}
