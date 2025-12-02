<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Vote;
use Livewire\Component;

class VoteButton extends Component
{
    public Item $item;
    public int $score;
    public ?int $userVote;

    public function mount(Item $item)
    {
        $this->item = $item;
        $this->refreshVotes();
    }

    public function refreshVotes()
    {
        $this->score = $this->item->votes()->sum('value');
        $this->userVote = auth()->check() 
            ? $this->item->votes()->where('user_id', auth()->id())->value('value')
            : null;
    }

    public function vote(int $value)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $existingVote = Vote::where('user_id', auth()->id())
            ->where('item_id', $this->item->id)
            ->first();

        if ($existingVote) {
            if ($existingVote->value === $value) {
                $existingVote->delete();
            } else {
                $existingVote->update(['value' => $value]);
            }
        } else {
            Vote::create([
                'user_id' => auth()->id(),
                'item_id' => $this->item->id,
                'value' => $value,
            ]);
        }

        $this->refreshVotes();
    }

    public function render()
    {
        return view('livewire.vote-button');
    }
}
