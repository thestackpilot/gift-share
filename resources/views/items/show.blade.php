<x-app-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Browse</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($item->title, 30) }}</li>
            </ol>
        </nav>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Photos & Main Info -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <!-- Photo Carousel -->
                @if($item->photos->count() > 0)
                    <div id="itemCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($item->photos as $index => $photo)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ $photo->path }}" class="d-block w-100" alt="{{ $item->title }}" 
                                         style="height: 400px; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>
                        @if($item->photos->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#itemCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#itemCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        @endif
                    </div>
                    
                    @if($item->photos->count() > 1)
                        <div class="p-3 border-bottom">
                            <div class="d-flex gap-2 overflow-auto">
                                @foreach($item->photos as $index => $photo)
                                    <img src="{{ $photo->path }}" 
                                         class="rounded cursor-pointer" 
                                         style="width: 80px; height: 60px; object-fit: cover; cursor: pointer;"
                                         data-bs-target="#itemCarousel" 
                                         data-bs-slide-to="{{ $index }}"
                                         alt="Thumbnail">
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                        <span class="text-muted">No photos available</span>
                    </div>
                @endif

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h3 class="mb-1">{{ $item->title }}</h3>
                            <div class="d-flex gap-2 align-items-center">
                                <span class="badge bg-secondary">{{ $item->category->name }}</span>
                                @if($item->isGifted())
                                    <span class="badge bg-success">Gifted</span>
                                @else
                                    <span class="badge bg-primary">Available</span>
                                @endif
                            </div>
                        </div>
                        <livewire:vote-button :item="$item" />
                    </div>

                    <hr>

                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Description</h6>
                        <p class="mb-0" style="white-space: pre-wrap;">{{ $item->description }}</p>
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                </svg>
                                <span>{{ $item->city }}</span>
                            </div>
                        </div>
                        @if($item->weight)
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
                                    </svg>
                                    <span>{{ $item->weight }} kg</span>
                                </div>
                            </div>
                        @endif
                        @if($item->dimensions)
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                        <path d="M1 1h14a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                                    </svg>
                                    <span>{{ $item->dimensions }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Comments -->
            <div class="card">
                <div class="card-body">
                    <livewire:comment-section :item="$item" />
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Posted by</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                            {{ strtoupper(substr($item->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <strong>{{ $item->user->name }}</strong>
                            <p class="text-muted small mb-0">Member since {{ $item->user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="text-muted small">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Posted:</span>
                            <span>{{ $item->created_at->format('M d, Y') }}</span>
                        </div>
                        @if($item->updated_at->ne($item->created_at))
                            <div class="d-flex justify-content-between">
                                <span>Updated:</span>
                                <span>{{ $item->updated_at->format('M d, Y') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if(auth()->id() === $item->user_id)
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('items.edit', $item) }}" class="btn btn-outline-primary">
                                Edit Item
                            </a>
                            <form action="{{ route('items.destroy', $item) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    Delete Item
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

