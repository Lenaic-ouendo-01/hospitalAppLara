<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ordinance extends Model
{
    use HasFactory;

    protected $fillable = [
        'results_id',
        'dosage',
        'drug',
        'usage_instruction',
        'state'
    ];

    public function result(): BelongsTo
    {
        return $this->belongsTo(Result::class);
    }
}
