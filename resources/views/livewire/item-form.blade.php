<div>
    <form wire:submit="save">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Item Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" wire:model="title" placeholder="What are you giving away?">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" wire:model="description" rows="5" 
                                      placeholder="Describe the item, its condition, and any other details..."></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select @error('category_id') is-invalid @enderror" 
                                        id="category_id" wire:model="category_id">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                       id="city" wire:model="city" placeholder="Enter your city">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="weight" class="form-label">Weight (kg)</label>
                                <input type="number" step="0.01" class="form-control @error('weight') is-invalid @enderror" 
                                       id="weight" wire:model="weight" placeholder="Optional">
                                @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="dimensions" class="form-label">Dimensions</label>
                                <input type="text" class="form-control @error('dimensions') is-invalid @enderror" 
                                       id="dimensions" wire:model="dimensions" placeholder="e.g., 30x20x10 cm">
                                @error('dimensions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        @if($isEdit)
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" wire:model="status">
                                    <option value="available">Available</option>
                                    <option value="gifted">Gifted</option>
                                </select>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Photos</h5>
                    </div>
                    <div class="card-body">
                        @if(count($existingPhotos) > 0)
                            <div class="mb-3">
                                <label class="form-label small text-muted">Current Photos</label>
                                <div class="photo-gallery">
                                    @foreach($existingPhotos as $photo)
                                        <div class="position-relative">
                                            <img src="{{ $photo['path'] }}" alt="Photo" class="rounded">
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                                                    wire:click="removeExistingPhoto({{ $photo['id'] }})">
                                                &times;
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="photos" class="form-label">{{ $isEdit ? 'Add More Photos' : 'Upload Photos' }}</label>
                            <input type="file" class="form-control @error('photos.*') is-invalid @enderror" 
                                   id="photos" wire:model="photos" multiple accept="image/*">
                            <div class="form-text">Max 5MB per image. You can select multiple files.</div>
                            @error('photos.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if(count($photos) > 0)
                            <div class="photo-gallery">
                                @foreach($photos as $index => $photo)
                                    <div class="position-relative">
                                        <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="rounded">
                                        <button type="button" 
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                                                wire:click="removePhoto({{ $index }})">
                                            &times;
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg" wire:loading.attr="disabled">
                        <span wire:loading.remove>{{ $isEdit ? 'Update Item' : 'Post Item' }}</span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm me-1"></span>
                            Saving...
                        </span>
                    </button>
                    <a href="{{ $isEdit ? route('items.show', $item) : route('dashboard') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
