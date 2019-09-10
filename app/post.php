<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\cuisine;
use App\review;
use App\opening;
use App\user;
use App\Http\Controllers\PostController;

class post extends Model
{
    protected $fillable = [
        'status','user_id','restaurant_name','subtitle','pricerange','is_vegan','is_vegetarian','is_date','url_homepage','url_menu','url_reservation','url_delivery','social_facebook','social_instagram','social_twitter','summary','review_food','review_style','review_service','is_draft','is_approved','is_declined','correction_id','place_location','place_adress','place_name','place_icon','img_1','img_2','img_3','img_4','img_5','img_6','img_title','img_logo','is_transport','is_groups','is_outside','is_takeawayonly','is_studying','social_tripadvisor'
    ];

    public function openings()
    {
        return $this->hasMany(opening::class);
    }

    public function cuisines()
    {
        return $this->belongsToMany(cuisine::class);
    }

    public function review() {
        return $this->belongsTo(review::class);
    }

    public function author()
    {
        return $this->belongsTo(user::class,'user_id');
    }

    public function my() {
        return $this->where(author(),auth()->user());
    }
    //Returns a review
    public function isLive() {
        //If there is a review that has this post as its post_id, then return the review, otherwise null
        return $this->hasOne(review::class,'post_id');
    }

    public function correction() {
        return $this->hasMany(post::class,'correction_id');
    }

    public function needs_review_errors() {
        $errors = collect();

        //(A) Make sure that this post actually needs to be reviewed, otherwise return with message.
        if($this->is_draft) {
            $errors->add('Action blocked, Post is in Draft.');
        }
        //(B) Post is already live
        if($this->isLive && $this->is_approved) {
            $errors->add('Action blocked, this post is already published by another editor. If this error remains, please contact...');

        }
        // (c) A newer version or revision of this post is already live
        if(PostController::has_greater_live_version($this)) {
            $errors->add('Action blocked, there is already an updated published version. Your actions have been undone. If this error remains, please contact...');
            $this->delete();
        }
        //(D) This post is declined
        if($this->is_declined) {
            $errors->add('Action blocked, Post has been declined by somebody else. If this error remains, please contact...');
        }

        return $errors;
    }
}
