<div class="mt-4">
    <h5 class="mb-3">Comments ({{ $comments->count() }})</h5>
    
    @auth
        <form wire:submit="addComment" class="mb-4">
            <div class="mb-3">
                <textarea class="form-control @error('body') is-invalid @enderror" 
                          wire:model="body" 
                          rows="2" 
                          placeholder="Add a comment..."></textarea>
                @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-sm" wire:loading.attr="disabled">
                <span wire:loading.remove>Post Comment</span>
                <span wire:loading>Posting...</span>
            </button>
        </form>
    @else
        <div class="alert alert-light mb-4">
            <a href="{{ route('login') }}">Log in</a> to leave a comment.
        </div>
    @endauth
    
    <div class="comments-list">
        @forelse($comments as $comment)
            <div class="d-flex mb-3 pb-3 border-bottom">
                <div class="avatar avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px; flex-shrink: 0;">
                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <strong class="small">{{ $comment->user->name }}</strong>
                            <span class="text-muted small ms-2">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        @if(auth()->id() === $comment->user_id)
                            <button class="btn btn-sm btn-link text-danger p-0" 
                                    wire:click="deleteComment({{ $comment->id }})"
                                    wire:confirm="Are you sure you want to delete this comment?">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        @endif
                    </div>
                    <p class="mb-0 mt-1">{{ $comment->body }}</p>
                </div>
            </div>
        @empty
            <p class="text-muted">No comments yet. Be the first to comment!</p>
        @endforelse
    </div>
</div>
