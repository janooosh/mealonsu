<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;

class TestController extends Controller
{
    public function tojs() {
        $posts = Post::all();
        return view('test.tojs', compact('posts'));
    }
}
