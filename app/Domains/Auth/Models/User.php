<?php

namespace App\Domains\Auth\Models;

use App\Domains\Auth\Models\Traits\Attribute\UserAttribute;
use App\Domains\Auth\Models\Traits\Method\UserMethod;
use App\Domains\Auth\Models\Traits\Relationship\UserRelationship;
use App\Domains\Auth\Models\Traits\Scope\UserScope;
use App\Domains\Auth\Notifications\Frontend\EmailPaymentGatewayAccountTokenNotification;
use App\Domains\Auth\Notifications\Frontend\EmailUnlockPasswordNotification;
use App\Domains\Auth\Notifications\Frontend\ResetPasswordNotification;
use App\Domains\Auth\Notifications\Frontend\VerifyEmail;
use DarkGhostHunter\Laraguard\Contracts\TwoFactorAuthenticatable;
use DarkGhostHunter\Laraguard\TwoFactorAuthentication;
use Database\Factories\UserFactory;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User.
 */
class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        HasRoles,
        Impersonate,
        MustVerifyEmailTrait,
        Notifiable,
        SoftDeletes,
        TwoFactorAuthentication,
        UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope;

    public const TYPE_ADMIN = 'admin';
    public const TYPE_USER = 'user';
    protected $keyType = 'string';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'firstName',
        'lastName',
        'email',
        'emailVerifiedAt',
        'password',
        'passwordChangedAt',
        'active',
        'timezone',
        'lastLoginAt',
        'lastLoginIp',
        'toBeLoggedOut',
        'provider',
        'providerId',
        'phoneNumber',
        'scoint',
        'address',
        'company',
        'avatar',
        'isLocked',
        'loginAttempts',
        'otpVerifyLoginPause',
        'telegramNotificationPause',
        'telegramToken',
        'telegramGroupId',
        'accessToken'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'rememberToken',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'lastLoginAt',
        'emailVerifiedAt',
        'passwordChangedAt',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'isLocked' => 'boolean',
        'lastLoginAt' => 'datetime',
        'emailVerifiedAt' => 'datetime',
        'toBeLoggedOut' => 'boolean',
        'otpVerifyLoginPause'  => 'boolean',
        'telegramNotificationPause'  => 'boolean',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'name'
    ];

    /**
     * @var string[]
     */
    protected $with = [
        'permissions',
        'roles',
    ];



    public function getNameAttribute()
    {
        return $this->lastName . ' ' . $this->firstName;
    }

    public function getAttribute($key)
    {
        $snakeKey = Str::snake($key);
        return parent::getAttribute($snakeKey);
    }


    public function setAttribute($key, $value)
    {
        $snakeKey = Str::snake($key);
        parent::setAttribute($snakeKey, $value);
    }


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Send the email to unlock
     *
     * @param  string  $token
     * @return void
     */
    public function sendEmailUnlockNotification($token): void
    {
        $this->notify(new EmailUnlockPasswordNotification($token));
    }


    /**
     * send
     *
     * @param  string  $token
     * @return void
     */
    public function sendPaymentGatewayAccountTokenEmail($token): void
    {
        $this->notify(new EmailPaymentGatewayAccountTokenNotification($token));
    }

    /**
     * Send the registration verification email.
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * Return true or false if the user can impersonate an other user.
     *
     * @param void
     * @return bool
     */
    public function canImpersonate(): bool
    {
        return $this->can('admin.access.user.impersonate');
    }

    /**
     * Return true or false if the user can be impersonate.
     *
     * @param void
     * @return bool
     */
    public function canBeImpersonated(): bool
    {
        return !$this->isMasterAdmin();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }

    public function generateToken()
    {
        $token = $this->createToken('API Token', ['*']);

        return $token->plainTextToken;
    }
}