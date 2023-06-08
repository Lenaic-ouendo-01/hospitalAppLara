<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Director extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hospital_id',
        'number',
        'sex',
        'nationality'
    ];

    public function hospital(): HasOne
    {
        return $this->hasOne(Hospital::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
