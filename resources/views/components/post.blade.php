<div class="post bg-white rounded-3 mb-3 d-flex">
    <div class="vote p-4 text-center">
        <h4 
        @auth
            class={{ hasVoted($post->id) == true ? "text-primary mb-1": "text-muted mb-1" }}>        
        @else 
            class="text-muted mt-1">
        @endauth
            {{ postVotes($post->id) }}
        </h4>
        <span class="text-muted text-sm mb-2 d-block">
            {{ __('messages.votes') }}
        </span>
        @auth            
            <button 
                {{ hasVoted($post->id) == true ?"disabled": '' }}
                wire:click.prevent="vote({{ $post->id }})" 
                class="btn btn-primary btn-sm">
                {{ hasVoted($post->id) == true ? __('messages.voted'): __('messages.vote') }}
            </button>
        @endauth
    </div>
    <div class="meme p-2 d-flex align-items-start position-relative w-100">
        <div class="image w-15 h-100">
            <a 
                href="{{ route('post', ['lang'=>App::currentLocale(), 'post'=>$post->id]) }}" 
                wire:click.prevent="showMeme({{ $post->id }})" 
                data-bs-toggle="modal" data-bs-target="#showMeme">                
                <img 
                    src="{{ asset('storage/'.$post->image) }}" 
                    class="w-100 h-100 object-contain" >
            </a>
        </div>
        <div class="ms-2">
            <a href="{{ route('post', ['lang'=>App::currentLocale(), 'post'=>$post->id]) }}" class="text-dark">
                <h6 class="my-1">{{ $post->title }}</h6>
            </a>
            <a href="#" class="d-block mb-1 text-sm">
                <i class="fa fa-user"></i> {{ $post->user->username }}
            </a>
            <div class="post-related text-sm mt-">
                <span class="d-inline-block text-muted">{{ $post->created_at->diffForHumans() }}</span>
                <span class="dot"></span>
                <span class="d-inline-block text-muted">{{ $post->category->title }}</span>
                <span class="dot"></span>
                <span class="d-inline-block">
                    <i class="fa fa-comment-o"></i> 
                    {{ $post->comments()->count() }} 
                    {{ __('messages.replies') }}
                </span>
            </div>
        </div>
        @auth            
            @if (Auth::user()->id == $post->user_id)
                <div class="position-absolute dots dropdown">
                    <a class="bg-light p-1 rounded-5 pointer dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span></span><span></span><span></span>
                    </a>
                    <ul class="dropdown-menu py-0">
                            <li>
                                <a 
                                    class="dropdown-item" 
                                    href="#"
                                    wire:click.prevent="deletePost({{ $post->id }})">
                                    <i class="fa fa-trash"></i> {{ __('messages.delete') }}
                                </a>   
                            </li>
                    </ul>
                </div>
            @endif
        @endauth
    </div>
</div>