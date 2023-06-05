<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lab_id',
        'clinic_id',
        'case_number',
        'patient_name',
        'gender',
        'due_date',
        'product_type',
        'payment_type',
        'expected_receive_date',
        'shade',
        'stain',
        'description',
        'is_fixed',
        'restoration_type',
        'all_ceramics',
        'post_and_core',
        'on_implant',
        'pfm',
        'full_cast',
        'acrylic_full_denture',
        'acrylic_partial_denture',
        'flexible',
        'cast_partial_denture',
        'immediates',
        'teeth',
        'miscellanceous'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }
}
