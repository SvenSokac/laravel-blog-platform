<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = 'about_pages';

    protected $fillable = [
        'description',
        'mission',
        'vision',
        'features',
        'stats',
    ];

    protected $casts = [
        'features' => 'array',
        'stats' => 'array',
    ];
}
