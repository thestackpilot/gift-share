<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Item;
use App\Models\Photo;
use Livewire\Component;
use Livewire\WithFileUploads;

class ItemForm extends Component
{
    use WithFileUploads;

    public ?Item $item = null;
    public bool $isEdit = false;

    public string $title = '';
    public string $description = '';
    public string $category_id = '';
    public string $city = '';
    public ?string $weight = null;
    public ?string $dimensions = null;
    public string $status = 'available';
    public array $photos = [];
    public array $existingPhotos = [];

    protected function rules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:5000',
            'category_id' => 'required|exists:categories,id',
            'city' => 'required|max:100',
            'weight' => 'nullable|numeric|min:0|max:9999.99',
            'dimensions' => 'nullable|max:50',
            'status' => 'required|in:available,gifted',
            'photos.*' => 'image|max:5120', // 5MB max
        ];
    }

    public function mount(?Item $item = null)
    {
        if ($item && $item->exists) {
            $this->item = $item;
            $this->isEdit = true;
            $this->title = $item->title;
            $this->description = $item->description;
            $this->category_id = (string) $item->category_id;
            $this->city = $item->city;
            $this->weight = $item->weight;
            $this->dimensions = $item->dimensions;
            $this->status = $item->status;
            $this->existingPhotos = $item->photos->toArray();
        }
    }

    public function removeExistingPhoto(int $photoId)
    {
        $this->existingPhotos = array_filter($this->existingPhotos, fn($p) => $p['id'] !== $photoId);
    }

    public function removePhoto(int $index)
    {
        unset($this->photos[$index]);
        $this->photos = array_values($this->photos);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'city' => $this->city,
            'weight' => $this->weight ?: null,
            'dimensions' => $this->dimensions ?: null,
            'status' => $this->status,
        ];

        if ($this->isEdit) {
            $this->item->update($data);
            $item = $this->item;

            // Remove deleted photos
            $keepIds = array_column($this->existingPhotos, 'id');
            Photo::where('item_id', $item->id)->whereNotIn('id', $keepIds)->delete();
        } else {
            $data['user_id'] = auth()->id();
            $item = Item::create($data);
        }

        // Save new photos
        $order = count($this->existingPhotos);
        foreach ($this->photos as $photo) {
            $path = $photo->store('items', 'public');
            Photo::create([
                'item_id' => $item->id,
                'path' => $path,
                'order' => $order++,
            ]);
        }

        session()->flash('success', $this->isEdit ? 'Item updated successfully!' : 'Item created successfully!');
        
        return redirect()->route('items.show', $item);
    }

    public function render()
    {
        return view('livewire.item-form', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}
