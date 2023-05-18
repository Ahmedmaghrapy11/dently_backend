<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillables = [
        'lab_id',
        'user_id',
        'name',
        'image',
        'description',
        'price'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lab() {
        return $this->belongsTo(Lab::class, 'lab_id');
    }
}
