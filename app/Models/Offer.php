<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillables = [
        'lab_id',
        'image'
    ];

    public function lab() {
        return $this->belongsTo(Lab::class, 'lab_id');
    }
}
