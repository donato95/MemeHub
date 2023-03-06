<?php

use App\Models\User;
use App\Models\Post;
use App\Models\Vote;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

// Check if user has voted or not
function hasVoted($post_id) {
    $vote = Auth::user()->votes()->where('post_id', $post_id)->first();
    if ($vote) {
        return true;
    }
    return false;
}

// Get post votes
function postVotes($post_id) {
    $post = Post::findOrFail($post_id);
    $votes = $post->votes()->count();
    return $votes++;
}