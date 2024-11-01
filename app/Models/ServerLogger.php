<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class ServerLogger extends BaseModel
{
    use HasFactory;
    protected $table = 'server_loggers';

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'message',
    ];
}
