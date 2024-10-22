<?php

namespace App\Domains\Subscription\Entities;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Subscription extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'subscription';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_id',
        'expired_at',
        'cancelled',
        'cancelled_reason',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getOs(): string
    {
        return $this->os;
    }

    public function isExpired()
    {
        return Carbon::parse($this->expired_at)->isPast();
    }

    public function scopeExpired($q)
    {
      return $q->where('expired_at','<',Carbon::now());
    }

    public function scopeRenewed($q)
    {
      return $q->whereColumn('updated_at','>','created_at');
    }


}
