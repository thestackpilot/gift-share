<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Item;
use Livewire\Component;

class CommentSection extends Component
{
    public Item $item;
    public string $body = '';

    protected $rules = [
        'body' => 'required|min:2|max:1000',
    ];

    public function mount(Item $item)
    {
        $this->item = $item;
    }

    public function addComment()
    {
        $this->validate();

        Comment::create([
            'user_id' => auth()->id(),
            'item_id' => $this->item->id,
            'body' => $this->body,
        ]);

        $this->body = '';
        $this->item->refresh();
    }

    public function deleteComment(int $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        
        if ($comment->user_id === auth()->id()) {
            $comment->delete();
            $this->item->refresh();
        }
    }

    public function render()
    {
        return view('livewire.comment-section', [
            'comments' => $this->item->comments()->with('user')->latest()->get(),
        ]);
    }
}
