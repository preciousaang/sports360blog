<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use Sluggable, Notifiable;
    protected $fillable = ['category_id', 'user_id', 'title', 'views', 'body', 'slug', 'image', 'featured', 'published'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
