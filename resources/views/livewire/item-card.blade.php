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
        @endif
    </div>
    
    <div class="card-body d-flex flex-column">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title mb-0">
                <a href="{{ route('items.show', $item) }}" class="text-decoration-none text-dark stretched-link">
                    {{ Str::limit($item->title, 40) }}
                </a>
            </h5>
        </div>
        
        <p class="card-text text-muted small flex-grow-1">
            {{ Str::limit($item->description, 80) }}
        </p>
        
        <div class="mt-auto">
            <div class="d-flex justify-content-between align-items-center text-muted small mb-2">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                    </svg>
                    {{ $item->city }}
                </span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                        <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5z"/>
                    </svg>
                    {{ $item->category->name }}
                </span>
            </div>
            
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">by {{ $item->user->name }}</small>
                <div class="position-relative" style="z-index: 2;">
                    <livewire:vote-button :item="$item" :key="'vote-'.$item->id" />
                </div>
            </div>
        </div>
    </div>
</div>
