<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $table = 'votes';
    protected $fillable = ['post_id', 'user_id'];

    // Relationship with posts
    public function post() {
        return $this->belongsTo(Post::class);
    }

    // Relationship with users
    public function user() {
        return $this->belongsTo(User::class);
    }
}
