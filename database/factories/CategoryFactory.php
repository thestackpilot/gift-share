<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Electronics',
            'Furniture',
            'Clothing',
            'Books',
            'Sports & Outdoors',
            'Toys & Games',
            'Home & Garden',
            'Kitchen',
            'Baby & Kids',
            'Art & Crafts',
            'Musical Instruments',
            'Pet Supplies',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
