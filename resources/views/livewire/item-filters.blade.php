<div class="card">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </span>
                    <input type="text" class="form-control" placeholder="Search items..." 
                           wire:model.live.debounce.300ms="search">
                </div>
            </div>
            
            <div class="col-md-2">
                <select class="form-select" wire:model.live="category">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-2">
                <select class="form-select" wire:model.live="city">
                    <option value="">All Cities</option>
                    @foreach($cities as $c)
                        <option value="{{ $c }}">{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-2">
                <select class="form-select" wire:model.live="status">
                    <option value="">All Status</option>
                    <option value="available">Available</option>
                    <option value="gifted">Gifted</option>
                </select>
            </div>
            
            <div class="col-md-2">
                <select class="form-select" wire:model.live="sort">
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="votes">Most Popular</option>
                </select>
            </div>
        </div>
        
        @if($search || $category || $city || $status)
            <div class="mt-3">
                <button class="btn btn-sm btn-outline-secondary" wire:click="clearFilters">
                    Clear all filters
                </button>
            </div>
        @endif
    </div>
</div>
