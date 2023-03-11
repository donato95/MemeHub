<div>  
    {{-- Meme post image --}}
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
                <div wire:loading>
                    <div class="d-flex justify-content-center p-4">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div wire:loading.remove class="modal-body">
                    <img src="{{ asset($memeImage) }}" alt="" class="w-100">
                </div>
            </div>
        </div>
    </div>
        
    <div class="container">
        {{-- <div class="my-3 user-nav d-flex align-items-center">
            <div class="image w-6">
                <img 
                    src="{{ asset('images/avatar.jpg') }}" 
                    class="w-100 img-thumbnail circled">
            </div>
            <div class="ms-2 dropdown">
                <span class="position-absolute red-dot"></span>
                <i class="fa fa-bell fa-2x text-muted dropdown-toggle no-arrow" data-bs-toggle="dropdown" aria-expanded="false"></i>
                <div class="dropdown-menu p-0 shadow">
                    <div class="list-group">
                        <a href="#" class="list-group-item border-none list-group-item-action d-flex gap-3 py-3" aria-current="true">
                            <img 
                                src="{{ asset('images/avatar.jpg') }}" 
                                class="rounded-circle flex-shrink-0" width="50" height="50">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                                <h6 class="mb-0">List group item heading</h6>
                                <p class="mb-0 opacity-75">Some placeholder content in a paragraph.</p>
                            </div>
                            <small class="opacity-50 text-nowrap">now</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row my-4">
            <div class="col-md-3">
                <div class="bg-white p-2 rounded-3">
                    <h5 class="text-center my-3">{{ __('messages.new_meme') }}</h5>
                    <p class="d-block text-sm px-2 text-center">
                        {{ __('messages.meme_desc') }}
                    </p>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <input 
                                type="text" 
                                name="title" 
                                placeholder="{{ __('messages.title') }}" 
                                class="bg-light rounded-3 form-control border-none"
                                wire:model.defer="title">
                            <div>
                                @error('title')
                                    <p class="my-2 text-sm text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <select name="category" wire:model.defer="category" class="text-sm form-select border-none bg-light">
                                <option value="0" class="text-sm">{{ __('messages.category') }}</option>
                                <div>
                                    @foreach ($categories as $category)
                                        <option class="text-sm" value="{{ $category->id }}">
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </div>
                            </select>
                        </div>
                        <div class="mb-2">
                            <textarea name="description" wire:model.defer="description"
                                placeholder="{{ __('messages.desc') }}" 
                                class="form-control bg-light rounded-3 border-none" rows="4"
                            ></textarea>
                            <div>
                                @error('description')
                                    <p class="my-2 text-sm text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="mb-2">
                            <input 
                                type="file" 
                                name="image" 
                                class="form-control bg-light border-none"
                                wire:model.defer="image">
                            <div>
                                @error('image')
                                    <p class="my-2 text-sm text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="mb-3">
                            <button 
                                type="submit" 
                                wire:click.prevent="store" 
                                class="btn btn-sm btn-primary text-white">
                                {{ __('messages.publish') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <x-messages />
                <x-filters :categories="$categories" />
                @forelse ($posts as $post)
                    <x-post :post="$post" />                                      
                @empty
                    <div class="bg-white border-none rounded-3 p-3">
                        <h4>Such an empty feed</h4>    
                    </div>            
                @endforelse
            </div>
        </div>
    </div>
</div>
