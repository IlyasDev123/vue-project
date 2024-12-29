<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'permission_status'
    ];

    protected $with = ['postMeta'];

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'first_name', 'last_name', 'avatar', 'created_at');
    }
    
    public function userlikesPosts()
    {
        return $this->belongsToMany(User::class, 'user_like_post', 'post_id', 'user_id');
    }

    public function likes(){
        return $this->hasMany(PostLike::class);
    }

    public function isAuthUserLikedPost(){
        return $this->likes()->where('user_id',  auth()->id())->exists();
     }

    public function postMeta()
    {
        return $this->hasMany(PostMeta::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
}