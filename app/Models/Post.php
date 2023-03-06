<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = ['title', 'description', 'image', 'category_id', 'user_id'];

    // Relationship with users
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    // Relationship with categories
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // Relatioship with comments
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // Relationship with votes
    public function votes() {
        return $this->hasMany(Vote::class);
    }

    // Order posts by top votes
    public function scopeOrderByTopVoted($query) {
        $query->leftJoin('votes', 'votes.post_id', '=', 'posts.id')
            ->selectRaw('posts.*, count(votes.id) as aggregate')
            ->groupBy('posts.id')
            ->orderBy('aggregate', 'desc');
    }
}
