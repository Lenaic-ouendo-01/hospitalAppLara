<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MedicalExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'typeExam',
        'dateExam',
        'medical_records_id',
        'doctors_id'
    ];

    public function medicalRecord(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class);
    }
    
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function result(): HasOne
    {
        return $this->hasOne(Result::class);
    }
}
