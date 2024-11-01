<?php
// app/Models/TransactionHistory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $table = 'transaction_history';

    protected $fillable = [
        'user_id',
        'transaction_time',
        'content',
        'transaction_code',
        'amount',
        'spoint',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
