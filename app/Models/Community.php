<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Community extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $fillable = ['user_id', 'description', 'name', 'slug'];

    public function topics(){
        return $this->belongsToMany(Topic::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
