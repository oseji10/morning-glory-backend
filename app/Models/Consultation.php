<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'company',
        'service_interest',
        'preferred_date',
        'message',
        'status', // pending | contacted | scheduled | closed
    ];

    protected $casts = [
        'preferred_date' => 'date',
    ];
}
