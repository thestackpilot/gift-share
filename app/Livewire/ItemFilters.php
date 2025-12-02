<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Item;
use Livewire\Component;

class ItemFilters extends Component
{
    public string $search = '';
    public string $category = '';
    public string $city = '';
    public string $status = '';
    public string $sort = 'newest';

    public function updated($property)
    {
        $this->dispatch('filtersUpdated', [
            'search' => $this->search,
            'category' => $this->category,
            'city' => $this->city,
            'status' => $this->status,
            'sort' => $this->sort,
        ]);
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->category = '';
        $this->city = '';
        $this->status = '';
        $this->sort = 'newest';
        
        $this->dispatch('filtersUpdated', [
            'search' => '',
            'category' => '',
            'city' => '',
            'status' => '',
            'sort' => 'newest',
        ]);
    }

    public function render()
    {
        return view('livewire.item-filters', [
            'categories' => Category::orderBy('name')->get(),
            'cities' => Item::select('city')->distinct()->orderBy('city')->pluck('city'),
        ]);
    }
}
