<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_id',
        'name',
        'material',
        'price'
    ];

    public function lab() {
        return $this->belongsTo(Lab::class, 'lab_id');
    }
}
