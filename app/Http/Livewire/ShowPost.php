<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowPost extends Component
{
    public $post;
    public $comment;
    public $comments;

    // Validation rules
    protected $rules = ['comment' => 'required|string'];

    // Get post method
    public function getPost($id) {
        return Post::findOrFail($id);
    }

    // Get all comments
    public function getComments() {
        $this->comments = $this->post->comments;
    }

    // Post Comment
    public function addComment($id) {
        $post = $this->getPost($id);
        $this->validate();
        $post->comments()->create([
            'content' => $this->comment,
            'post_id' => $post->id,
            'user_id' => Auth::user()->id
        ]);
        $this->comment = NULL;
        $this->getComments();
        $this->post = $post;
        session()->flash('success', 'Comment added successfully');
    }

    // Remove comment from post
    public function removeComment($id) {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        $this->post = $this->getPost($this->post->id);
        session()->flash('success', 'Comment removed successfully');
    }

    // Delete meme post
    public function deletePost($post_id) {
        $post = $this->getPost($post_id);
        $post->delete();
        session()->flash('success', 'Meme deleted successfully');
        return redirect()->route('home')->with('success', 'Post deleted successfully');
        // $this->posts = $this->allPosts();
    }

    public function mount() {
        // $this->post = $this->getPost($id);
    }

    public function render()
    {
        $this->getComments();
        return view('livewire.show-post');
    }
}
