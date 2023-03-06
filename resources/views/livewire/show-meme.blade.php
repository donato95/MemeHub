<div>
    <div wire:ignore.self class="modal" id="showMeme" tabindex="-1" aria-labelledby="meme" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-header border-none">
                <button 
                    {{-- wir:click.prevent="removeCurrentImage" --}}
                    type="button" 
                    class="btn-close pointer" 
                    data-bs-dismiss="modal" aria-label="Close"></button>
                </div>        
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset($memeImage) }}" alt="" class="w-100">
                </div>
            </div>
        </div>
    </div>
</div>
