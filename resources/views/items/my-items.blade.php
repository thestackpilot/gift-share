<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-semibold">My Items</h4>
            <a href="{{ route('items.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                Post New Item
            </a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($items->count() > 0)
        <div class="row g-4">
            @foreach($items as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card item-card h-100">
                        <div class="position-relative">
                            @if($item->primaryPhoto)
                                <img src="{{ $item->primaryPhoto->path }}" class="card-img-top" alt="{{ $item->title }}">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span class="text-muted">No photo</span>
                                </div>
                            @endif
                            
                            @if($item->isGifted())
                                <span class="badge bg-success badge-gifted">Gifted</span>
                            @else
                                <span class="badge bg-primary badge-gifted">Available</span>
                            @endif
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ Str::limit($item->title, 40) }}</h5>
                            <p class="card-text text-muted small flex-grow-1">
                                {{ Str::limit($item->description, 80) }}
                            </p>
                            
                            <div class="d-flex gap-2 mt-auto">
                                <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-outline-primary flex-grow-1">View</a>
                                <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-outline-secondary flex-grow-1">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $items->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">
            <h5 class="mb-2">You haven't posted any items yet</h5>
            <p class="mb-3">Start sharing by posting your first item!</p>
            <a href="{{ route('items.create') }}" class="btn btn-primary">Post Your First Item</a>
        </div>
    @endif
</x-app-layout>

