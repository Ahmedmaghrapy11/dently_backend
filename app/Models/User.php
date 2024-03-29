<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
    ];

    public function clinics() {
        return $this->hasMany(Clinic::class, 'user_id');
    }

    public function labs() {
        return $this->hasMany(Lab::class, 'user_id');
    }

    public function favourites() {
        return $this->belongsToMany(Lab::class, 'lab_favourites');
    }

    public function ratings() {
        return $this->hasMany(Lab::class, 'ratings');
    }

    public function orders() {
        return $this->hasMany(Order::class, 'order_id');
    }

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
}
