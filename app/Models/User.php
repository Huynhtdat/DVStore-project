<?php

namespace App\Models;

use App\Notifications\VerifyUser;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, MustVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'phone_number',
        'email_verified_at',
        'active',
        'disable_reason',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id', 'user_id')->setEagerLoads([]);
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'id', 'user_id')->setEagerLoads([]);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id')->setEagerLoads([]);
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function resendEmailVerificationNotification($token)
    {
        $this->notify(new VerifyUser($token));
    }

    /**
     * Hash the password before inserting database.
     *
     * @var string $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
