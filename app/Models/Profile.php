<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Profile extends Model
{
    protected $guarded =[];
    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : '/profile/rpjWANiNX1IUREmqvBS2Xg2A8udTQZP5zvE6bkkb.png';
        return '/storage/'. $imagePath;
    }
    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
