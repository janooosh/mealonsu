<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class role extends Model
{
    protected $fillable = [
        'name','description'
    ];

    public function users() {
        return $this->belongsToMany('App\user');
    }
}
