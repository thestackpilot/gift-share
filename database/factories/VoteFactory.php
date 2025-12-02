<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'item_id' => Item::factory(),
            'value' => fake()->randomElement([1, 1, 1, -1]), // 75% upvotes
        ];
    }

    public function upvote(): static
    {
        return $this->state(fn () => ['value' => 1]);
    }

    public function downvote(): static
    {
        return $this->state(fn () => ['value' => -1]);
    }
}
