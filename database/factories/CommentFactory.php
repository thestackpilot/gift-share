<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    private array $comments = [
        'Is this still available?',
        'I would love to have this!',
        'Can I pick it up this weekend?',
        'This looks great, thanks for sharing!',
        'What condition is it in?',
        'How old is this item?',
        'I can pick up anytime!',
        'Perfect for what I need!',
        'Thanks for giving this away!',
        'Does it work properly?',
        'Any scratches or damage?',
        'This would be perfect for my kids!',
        'Very generous of you to share this!',
        'I\'ve been looking for one of these!',
        'Can you hold it for me until tomorrow?',
    ];

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'item_id' => Item::factory(),
            'body' => fake()->randomElement($this->comments),
        ];
    }
}
