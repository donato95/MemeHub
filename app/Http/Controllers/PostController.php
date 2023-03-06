<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show single post page
    public function post(Post $post) {
        return view('main.post', compact('post'));
    }
}
