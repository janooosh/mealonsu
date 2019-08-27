<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class opening extends Model
{
    protected $fillable = [
        'post_id','day','from','to'
    ];
}
