<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

class PaymentGatewayAccount extends BaseModel
{
    use HasFactory;

    protected $table = 'payment_gateway_accounts';
    protected $primaryKey = "id";
    protected $keyType = 'string';
    public $incrementing = false;

    const STATUSES = [
        // sử dụng khi PaymentGatewayAccount mới được thêm vào và chưa login lần nào 
        // Hoặc khi user thay đổi thông tin login như password
        "INIT" => "init",
        // Dùng khi login lần đầu thất bại
        "STOP" => "stop",
        // Sử dụng khi đã login success 1 lần
        "READY" => "ready",
        // Sử dụng khi login thất bại - dùng để yêu cầu user cung cấp lại PaymentGatewayAccount này.
        "SKIP" => "skip",
    ];

    /*
        Tóm tắt:
        - Khi user lần đầu thêm tài khoản vào
            + Lần cron đầu tiên sẽ login tài khoản:
                * Thành công: init -> ready
                * Thất bại: init -> stop
            + Nếu lần cron đầu login thành công những lần sau sẽ chỉ lấy history:
                * Trong history cho phép login lại 1 lần (nếu get history fail)
                    * login thành công -> tiếp tục
                    * login thất bại -> ready -> stop và yêu cầu người dùng thêm lại
        - stop và skip đều dùng để ngăn cản login và yêu cầu user đăng nhập lại nhưng khác ở chỗ stop là sai ở lần đăng nhập đầu,
            skip là khi hết phiên hoặc có sự thay đổi thông tin

    */


    protected $fillable = [
        'account_no',
        'payment_gateway_id',
        'user_id',
        'password',
        'token',
        'pause',
        'time_end',
        'account_data',
        'user_package_id',
        'last_cron',
        'status',
    ];


    protected $guarded = ['id'];

    protected $appends = [
        'accountName',
    ];

    protected $casts = [
        'account_data' => 'json',
        'pause' => 'boolean'
    ];


    public function getKeyName()
    {
        return 'id';
    }


    public function paymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userPackage()
    {
        return $this->belongsTo(UserPackage::class);
    }

    public static function getTableName()
    {
        return (new self())->getTable();
    }



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
        });
    }


    public function getAccountNameAttribute()
    {
        // $accountData = json_decode($this->accountData);
        // dd($accountData);
        // $accountData = $this->accountData;
        $accountData = (object) $this->accountData;

        if ($accountData && isset($accountData->accountName)) {
            return $accountData->accountName;
        } else {
            return "";
        }
    }
}
