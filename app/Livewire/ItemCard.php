<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class ItemCard extends Component
{
    public Item $item;

    public function mount(Item $item)
    {
        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.item-card');
    }
}
