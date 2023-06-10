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
        'delivary_times',
        'phone',
        'maxillofacial',
        'digital',
        'pay_per_month',
    ];

    protected $appends = [
        'rate'
    ];

    public function getRateAttribute() {
        return $this->ratings->avg('rate');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products() {
        return $this->hasMany(Product::class, 'product_id');
    }

    public function orders() {
        return $this->hasMany(Order::class, 'order_id');
    }

    public function ratings() {
        return $this->hasMany(Ratings::class);
    }
}
