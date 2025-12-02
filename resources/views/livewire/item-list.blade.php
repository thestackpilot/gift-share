<div>
    <livewire:item-filters />
    
    <div class="row g-4 mt-3">
        @forelse($items as $item)
            <div class="col-md-6 col-lg-4">
                <livewire:item-card :item="$item" :key="$item->id" />
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <h5 class="mb-2">No items found</h5>
                    <p class="mb-0">Try adjusting your filters or <a href="{{ route('items.create') }}">post a new item</a>.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $items->links() }}
    </div>
</div>
