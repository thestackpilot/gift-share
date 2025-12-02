<x-app-layout>
    <x-slot name="header">
        <h4 class="mb-0 fw-semibold">Edit Item</h4>
    </x-slot>

    <livewire:item-form :item="$item" />
</x-app-layout>

