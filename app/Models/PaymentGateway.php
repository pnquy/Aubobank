<?php

namespace App\Models;

use Illuminate\Support\Str;

class PaymentGateway extends BaseModel
{

    protected $table = 'payment_gateways';

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    const BRANDS = [
        "MOMO" => "momo",
        "ACB" => "acb",
        "TECHCOMBANK" => "techcombank",
        "VIETCOMBANK" => "vietcombank",
        "ZALOPAY" => "zalopay",
        "TPBANK" => "tpbank",
        "MBBANK" => "mbbank",
        "THESIEURE" => "thesieure",
        "VIETTELPAY" => "viettelpay",
    ];

    const TYPES = [
        "WALLET" => "wallet",
        "BANK" => "bank",
    ];

    const STATUSES = [
        "READY" => "ready",
        "COMMING_SOON" => "comming_soon",
        "MAINTENANCE" => "maintenance",
    ];



    protected $fillable = ['name', 'brand', 'status', 'logo', 'sort_number', 'flag'];

    protected $casts = [
        'status' => 'string',
        'sort_number' => 'integer',
        'flag' => 'integer',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = $model->id ?: (string) Str::uuid();
        });
    }

    public static function getBrandOptions()
    {
        return array_values(self::BRANDS);
    }




    public function paymentGatewayAccounts()
    {
        return $this->hasMany(PaymentGatewayAccount::class);
    }

    public function paymentGatewayPackages()
    {
        return $this->hasMany(PaymentGatewayPackage::class);
    }


    static public function getAllAvailablePaymentGateways()
    {
        $paymentGateways = self::where('status', '<>', self::STATUSES['COMMING_SOON'])
            ->orderBy('sort_number')
            ->get();

        return $paymentGateways;
    }


    static public function getAllAvailablePaymentGatewaysByType($type)
    {
        $paymentGateways = self::where('status', '<>', self::STATUSES['COMMING_SOON'])->where('type', $type)
            ->orderBy('sort_number')
            ->get();

        return $paymentGateways;
    }
}
