<div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-dismiss="alert" data-label="Close"></button>	
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" data-label="Close"></button>	
            <strong>{{ $message }}</strong>
        </div>
    @endif
</div>