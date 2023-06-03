<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Role extends Model
{
    use HasFactory;

    const PATIENT = 'PATIENT';
    const DOCTOR = 'DOCTOR';
    const DIRECTOR = 'DIRECTOR';

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
