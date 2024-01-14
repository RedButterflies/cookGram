<?php

namespace App\Models;

use App\Http\Controllers\CommentsController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
    use HasFactory;
}
