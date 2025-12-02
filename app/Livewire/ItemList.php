<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Item;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ItemList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url]
    public ?string $search = '';

    #[Url]
    public ?string $category = '';

    #[Url]
    public ?string $city = '';

    #[Url]
    public ?string $status = '';

    #[Url]
    public string $sort = 'newest';

    protected $listeners = ['filtersUpdated' => 'updateFilters'];

    public function updateFilters($filters)
    {
        $this->search = $filters['search'] ?? '';
        $this->category = $filters['category'] ?? '';
        $this->city = $filters['city'] ?? '';
        $this->status = $filters['status'] ?? '';
        $this->sort = $filters['sort'] ?? 'newest';
        $this->resetPage();
    }

    public function render()
    {
        $query = Item::with(['user', 'category', 'photos', 'votes'])
            ->search($this->search)
            ->filterByCategory($this->category ? (int) $this->category : null)
            ->filterByCity($this->city ?: null)
            ->filterByStatus($this->status ?: null);

        $query = match ($this->sort) {
            'oldest' => $query->oldest(),
            'votes' => $query->withSum('votes', 'value')->orderByDesc('votes_sum_value'),
            default => $query->latest(),
        };

        return view('livewire.item-list', [
            'items' => $query->paginate(12),
            'categories' => Category::orderBy('name')->get(),
            'cities' => Item::select('city')->distinct()->orderBy('city')->pluck('city'),
        ]);
    }
}
