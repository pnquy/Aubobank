<?php

namespace App\Models;


use Illuminate\Support\Str;

class Setting extends BaseModel
{
    protected $table = 'settings';

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'value',
    ];

    const NAMES = [
        "MOMO_RUN" => "momo_run",
        "ACB_RUN" => "acb_run",
        "TECHCOMBANK_RUN" => "techcombank_run",
        "VIETCOMBANK_RUN" => "vietcombank_run",
        "ZALOPAY_RUN" => "zalopay_run",
        "TPBANK_RUN" => "tpbank_run",
        "MBBANK_RUN" => "mbbank_run",
        "THESIEURE_RUN" => "thesieure_run",
        "VIETTELPAY_RUN" => "viettelpay_run",
    ];
}
