<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankTransLog extends BaseModel
{
    use HasFactory;
    protected $table = 'bank_trans_logs';

    // protected $primaryKey = ['accountNo', 'paymentGatewayId', 'transactionId'];
    // public $incrementing = false;
    // protected $keyType = 'string';

    protected $fillable = [
        'account_no',
        'transaction_id',
        'payment_gateway_id',
        'amount',
        'description',
        'transaction_date',
        'type',
        'balance',
        'object_data'
    ];


    protected $casts = [
        'transaction_date' => 'datetime',
        'object_data' => 'json'
    ];

    const TYPES = [
        "IN" => "IN",
        "OUT" => "OUT",
    ];


    public function paymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }
}
