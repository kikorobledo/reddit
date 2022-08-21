<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\PostVote;
use App\Models\Community;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['community_id', 'author_id', 'title', 'post_text', 'post_image', 'post_url', 'user_id','votes'];

    public function community(){
        return $this->belongsTo(Community::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class)->latest();
    }

    public function postVotes(){
        return $this->hasMany(PostVote::class);
    }
}
