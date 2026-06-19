<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Tag;
use App\Models\Reaction;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'images',
        'author_name',
        'author_initials',
        'published_at'
    ];

    protected $casts = [
        'images' => 'array',
        'published_at' => 'datetime'
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function reactions(): HasMany
    {
        return $this->hasMany(Reaction::class);
    }

    public function getReactionCount(string $emoji): int
    {
        $reaction = $this->reactions()->where('emoji', $emoji)->first();
        return $reaction ? $reaction->count : 0;
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('excerpt', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%");
        });
    }

    public function scopeCategory($query, $category)
    {
        return $category ? $query->where('category', $category) : $query;
    }

    public function scopeWithTag($query, $tagSlug)
    {
        return $tagSlug ? $query->whereHas('tags', function ($q) use ($tagSlug) {
            $q->where('slug', $tagSlug);
        }) : $query;
    }
}
