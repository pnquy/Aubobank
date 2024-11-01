<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MomoAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_name',
        'phone_number',
        'password',
        'balance',
        'added_at',
        'last_cron'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}