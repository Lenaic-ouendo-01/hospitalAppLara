<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number_fix',
        'email',
        'address',
        'city',
        'number_mobile',
        'number_urgence',
        'hours',
        'description',
        'language',
        'director_id'
    ];

    public function hospitalServices(): HasMany
    {
        return $this->hasMany(HospitalService::class);
    }

    public function director(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
