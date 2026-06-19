<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;
    protected $table = 'reactions';

    protected $fillable = ['post_id', 'emoji', 'count'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
