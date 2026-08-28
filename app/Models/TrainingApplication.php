<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'qualification',
        'preferred_cohort',
        'referral_source',
        'motivation',
        'status', // pending | reviewed | accepted | enrolled | rejected
    ];
}
