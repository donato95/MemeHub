<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = ['content', 'post_id', 'user_id'];

    // Relationship with posts
    public function post() {
        return $this->belongsTo(Post::class);
    }

    // Relationship with users
    public function author() {
        return $this->belongsTo(User::class);
    }
}
