<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'summary',
        'body',
        'features',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array', // bullet list e.g. "Management Accounts", "CFO Advisory"...
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
