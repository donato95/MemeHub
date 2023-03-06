<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Post;
use App\Models\Vote;

class Index extends Component
{
    use WithFileUploads;

    protected $queryString = ['cate', 'filter', 'search'];

    // Request query variables
    public $search;
    public $filter;
    public $cate;

    // Post related variables
    // public $posts;
    public $categories;
    public $memeImage;
    public $memeId;

    // Css class
    public $voteClass = 'text-muted';

    // Create meme post form fields
    public $title;
    public $description;
    public $image;
    public $category;

    protected $rules = [
        'title' => 'required|string',
        'description' => 'required|string',
        'image' => 'required|mimes:jpg,pnj,jpeg',
        'category' => 'required|integer|min:1',
        'search' => 'nullable|string',
        'filter' => 'nullable|integer',
        'cate' => 'nullable|integer'
    ];

    // Get posts helper function
    public function allPosts() {
        return Post::orderBy('created_at', 'DESC')->get();
    }

    // Get single post helper function
    public function getPost($id) {
        return Post::findOrFail($id);
    }

    // Clear all form data
    public function clearMemeFields() {
        $this->title = NULL;
        $this->description = NULL;
        $this->category = NULL;
        $this->image = NULL;
    }

    // Submit and publish new meme
    public function store() {
        // dd($this->category);
        $this->validate();
        $path = $this->image->store('memes', 'public');
        $post = Post::create([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $path,
            'user_id' => Auth::user()->id,
            'category_id' => $this->category
        ]);
        if($post) {
            $this->clearMemeFields();
            session()->flash('success', 'Meme published successfully');
            // $this->posts = $this->allPosts();       
        } else {
            session()->flash('danger', 'Meme couldn\'t be published'); 
            return;   
        }
    }

    // Show meme modal
    public function showMeme($id) {
        $currentMeme = $this->getPost($id);
        $this->memeImage = 'storage/'.$currentMeme->image;
        $this->memeId = $id;
    }

    // Post a vote
    public function vote($post_id) {
        $post = $this->getPost($post_id);
        $vote = Vote::create([
            'post_id' => $post->id,
            'user_id' => Auth::user()->id
        ]);
        if($vote) {
            $this->voteClass = 'text-primary';
        } else {
            session()->flash('danger', 'Couldn\'t vote'); 
            return;   
        }
    }

    // Delete meme post
    public function deletePost($post_id) {
        $post = Post::findOrFail($post_id);
        $post->delete();
        session()->flash('success', 'Meme deleted successfully');
        // $this->posts = $this->allPosts();
    }

    public function mount() {
        $this->categories = Category::all();
        // $this->posts = $this->allPosts();
    }

    public function render()
    {
        $posts = $this->allPosts();
        if(strlen($this->search) > 0) {
            $this->filter = NULL;
            $this->cate = NULL;
            $posts = Post::where('title' , 'LIKE', '%'.$this->search.'%')->get();
        }

        if(intval($this->filter) > 0) {
            $this->cate = NULL;
            $this->search = NULL;
            switch ($this->filter) {
                case '1':
                    $posts = Post::orderByTopVoted()->get();
                    break;
                // 
                default:
                    $posts = $this->allPosts();
                    break;
            }
        }

        if(intval($this->cate) > 0) {
            $this->filter = NULL;
            $this->search = NULL;
            $posts = Post::orderBy('created_at', 'DESC')->where('category_id', $this->cate)->get();
        }

        return view('livewire.index', compact('posts'));
    }
}
