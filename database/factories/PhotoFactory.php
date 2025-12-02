<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    public function definition(): array
    {
        // Using placeholder images
        $width = fake()->randomElement([400, 600, 800]);
        $height = fake()->randomElement([300, 400, 600]);
        
        return [
            'item_id' => Item::factory(),
            'path' => "https://picsum.photos/{$width}/{$height}?random=" . fake()->unique()->randomNumber(5),
            'order' => fake()->numberBetween(0, 5),
        ];
    }
}
