<?php

namespace App\Models;


class PaymentGatewayPackage extends BaseModel
{
    protected $table = 'payment_gateway_packages';
    protected $primaryKey = 'id';
    protected $keyType = 'string';


    protected $fillable = [
        'payment_gateway_id',
        'package_id',
        'usage_account_limit'
    ];

    protected $casts = [
        'usage_account_limit' => 'integer'
    ];


    // Relationship with PaymentGateway model
    public function paymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }

    // Relationship with Package model
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
