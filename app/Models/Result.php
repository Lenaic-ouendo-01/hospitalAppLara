<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_exam_id',
        'result'
    ];

    public function ordinances(): HasMany
    {
        return $this->hasMany(Ordinance::class);
    }

    public function medicalExam(): BelongsTo
    {
        return $this->belongsTo(MedicalExam::class);
    }
}
