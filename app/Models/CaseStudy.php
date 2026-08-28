<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'body',
        'industry',
        'stats', // json: [{ "value": "₦120M", "label": "COST SAVINGS" }, ...]
        'published_at',
    ];

    protected $casts = [
        'stats' => 'array',
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
