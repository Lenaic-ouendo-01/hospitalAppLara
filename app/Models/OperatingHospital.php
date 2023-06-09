<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatingHospital extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'hospital_id',
        'is_active'
    ];
}
