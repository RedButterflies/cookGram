<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'content',
    ];

    // Relacja z modelem User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacja z modelem Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
