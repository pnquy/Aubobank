<?php

namespace App\Models;

class Package extends BaseModel
{
    protected $table = 'packages';
    protected $primaryKey = "id";
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'description',
        'price'
    ];

    protected $casts = [
        'price' => 'integer',
    ];

    public function paymentGatewayPackages()
    {
        return $this->hasMany(PaymentGatewayPackage::class);
    }

    public function userPackages()
    {
        return $this->hasMany(UserPackage::class);
    }
}
