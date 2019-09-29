<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\post;

class cuisine extends Model
{
    protected $fillable = [
        'name'
    ];

    public function posts()
    {
        return $this->belongsToMany(post::class)->where('is_approved',true)->where('is_draft',false)->whereHas('isLive');
    }

}
