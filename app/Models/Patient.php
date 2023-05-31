<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'nation',
        'sex',
        'birth',
        'address',
        'profession',
        'allergies',
        'history_diseases',
        'ex_surgery',
        'vaccine',
        'hereditary',
        'insurance',
        'emergency_contact',
        'blood_type',
        'language',
        'marital_status',
        'users_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function medicalRecord(): HasOne
    {
        return $this->hasOne(MedicalRecord::class);
    }
}
