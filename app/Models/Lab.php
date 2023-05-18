<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $fillables = [
        'name',
        'longitude',
        'latitude',
        'delivery_times',
        'phone',
        'image',
        'maxillofacial',
        'digital',
        'pay_per_month',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
