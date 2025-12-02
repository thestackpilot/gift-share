<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return view('items.index');
    }

    public function create()
    {
        return view('items.create');
    }

    public function show(Item $item)
    {
        $item->load(['user', 'category', 'photos', 'comments.user', 'votes']);
        
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        
        return view('items.edit', compact('item'));
    }

    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);
        
        $item->delete();
        
        return redirect()->route('dashboard')
            ->with('success', 'Item deleted successfully.');
    }

    public function myItems()
    {
        $items = auth()->user()->items()
            ->with(['category', 'photos'])
            ->latest()
            ->paginate(12);
        
        return view('items.my-items', compact('items'));
    }
}
