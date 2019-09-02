<?php

namespace App;
use App\post;
use App\user;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $fillable = [
        'user_id','post_id'
    ];
    public function posts() {
        return $this->hasMany('App\post');
    }
    public function current_post() {
        return $this->belongsTo('App\post','post_id');
    }
    //Yeah i know same as current_post, but must be a quick fix... all.blade.php
    public function post() {
        return $this->belongsTo('App\post', 'post_id');
    }
    public function author() {
        return $this->belongsTo('App\User','user_id');
    }

    public function published_posts() {

    }

}
