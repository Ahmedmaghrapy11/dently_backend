<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'longitude',
        'latitude',
        'city',
        'image',
        'delivery_times',
        'phone',
        'image',
        'maxillofacial',
        'digital',
        'pay_per_month',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products() {
        return $this->hasMany(Product::class, 'product_id');
    }
}
