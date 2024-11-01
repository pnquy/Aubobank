<?php

namespace App\Models;

use App\Domains\Auth\Models\User;
use Ramsey\Uuid\Uuid;

class UserPackage extends BaseModel
{
    protected $table = 'user_packages';
    protected $primaryKey = "id";


    protected $keyType = 'string';
    public $incrementing = false;


    protected $fillable = [
        'user_id',
        'package_id',
        'time_limit',
        'time_start',
        'time_end',
    ];

    protected $casts = [
        'time_start' => 'datetime',
        'time_end' => 'datetime',
        'time_limit' => 'integer',
    ];

    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
        });
    }
}
