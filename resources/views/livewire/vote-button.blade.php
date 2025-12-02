<div class="d-flex align-items-center gap-1" wire:click.stop>
    <button class="btn btn-sm vote-btn {{ $userVote === 1 ? 'btn-primary' : 'btn-outline-secondary' }}" 
            wire:click="vote(1)" 
            title="Upvote">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
        </svg>
    </button>
    
    <span class="fw-semibold px-1 {{ $score > 0 ? 'text-success' : ($score < 0 ? 'text-danger' : 'text-muted') }}">
        {{ $score }}
    </span>
    
    <button class="btn btn-sm vote-btn {{ $userVote === -1 ? 'btn-danger' : 'btn-outline-secondary' }}" 
            wire:click="vote(-1)" 
            title="Downvote">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
        </svg>
    </button>
</div>
