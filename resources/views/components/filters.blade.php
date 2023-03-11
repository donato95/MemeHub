<div class="row">
    <div class="col-md-4">
        <select name="cate" wire:model="cate" class="form-select bg-white rounded-3 border-none">
            <option value="0">{{ __('messages.all') }}</option>
            @foreach ($categories as $category)
                <option class="text-sm" value="{{ $category->id }}">
                    {{ $category->title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <select name="filter" wire:model="filter" class="form-select bg-white rounded-3 border-none">
            <option value="0">{{ __('messages.filter') }}</option>
            <option value="1">{{ __('messages.top') }}</option>
        </select>
    </div>
    <div class="col-md-4">
        <div class="input-group mb-3">
            <span class="input-group-text border-none bg-white" id="basic-addon1">
                <i class="fa fa-search"></i>
            </span>
            <input 
                type="text" 
                name="search" 
                wire:model="search" 
                class="form-control border-none" 
                placeholder="{{ __('messages.search') }}..." 
                aria-label="Username" 
                aria-describedby="basic-addon1">
        </div>
    </div>
</div>