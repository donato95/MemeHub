<div class="pb-4">
    <x-post :post="$post" />
    <div class="bg-white rounded-3 p-2">
        <form action="" method="post">
            @csrf
            <textarea 
                name="comment" 
                cols="10" rows="4" 
                placeholder="{{ __('messages.reply') }}..."
                class="form-control bg-light mb-3"
                wire:model.defer="comment"
            ></textarea>
            <button wire:click.prevent="addComment({{ $post->id }})" type="submit" class="btn btn-sm btn-primary">
                {{ __('messages.reply') }}
            </button>
        </form>
    </div>
    <div class="comments mt-3">
        @forelse ($comments as $comment)
            <div class="bg-white rounded-3 mb-2 comment">
                <div class="meme p-2 d-flex align-items-start position-relative w-100">
                    <div class="image w-10 h-100">
                        <a href="#">                
                            <img 
                                src="{{ asset('images/avatar.jpg') }}" 
                                class="w-100 h-100 object-contain" >
                        </a>
                    </div>
                    <div class="ms-2 d-flex flex-column">
                        <p class="text-sm mb-1">
                            {{ $comment->content }}
                        </p>
                        <a 
                            wire:click.prevent="removeComment({{ $comment->id }})" 
                            href="#" class="tex-primary d-block">
                            {{ __('messages.delete') }}
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white p-2 rounded-3 text-center">
                {{ __('messages.no_comments') }}
            </div>  
        @endforelse
    </div>
</div>
