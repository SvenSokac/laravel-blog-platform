<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'category',
        'author_name',
        'author_initial',
        'published_date',
        'tags',
        'images',
        'social_links',
    ];

    protected $casts = [
        'tags' => 'array',
        'images' => 'array',
        'social_links' => 'array',
        'published_date' => 'date',
    ];

    public function reactions(): HasMany
    {
        return $this->hasMany(Reaction::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->with('replies')->orderBy('created_at', 'desc');
    }
}
