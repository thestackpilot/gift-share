<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Item;
use App\Models\Photo;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $categories = [
            'Electronics', 'Furniture', 'Clothing', 'Books', 
            'Sports & Outdoors', 'Toys & Games', 'Home & Garden', 
            'Kitchen', 'Baby & Kids', 'Art & Crafts',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }

        // Create test user
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create additional users
        $users = User::factory(19)->create();
        $allUsers = $users->push($testUser);

        // Create items for each user
        $allUsers->each(function ($user) {
            $itemCount = rand(1, 4);
            
            Item::factory($itemCount)->create([
                'user_id' => $user->id,
                'category_id' => Category::inRandomOrder()->first()->id,
            ])->each(function ($item) {
                // Add 1-4 photos per item
                $photoCount = rand(1, 4);
                for ($i = 0; $i < $photoCount; $i++) {
                    Photo::create([
                        'item_id' => $item->id,
                        'path' => "https://picsum.photos/600/400?random=" . rand(1, 10000),
                        'order' => $i,
                    ]);
                }
            });
        });

        // Get all items
        $items = Item::all();

        // Add comments to items
        $items->each(function ($item) use ($allUsers) {
            $commentCount = rand(0, 5);
            $commenters = $allUsers->where('id', '!=', $item->user_id)->random(min($commentCount, $allUsers->count() - 1));
            
            foreach ($commenters as $commenter) {
                Comment::factory()->create([
                    'user_id' => $commenter->id,
                    'item_id' => $item->id,
                ]);
            }
        });

        // Add votes to items
        $items->each(function ($item) use ($allUsers) {
            $voteCount = rand(0, 10);
            $voters = $allUsers->where('id', '!=', $item->user_id)->random(min($voteCount, $allUsers->count() - 1));
            
            foreach ($voters as $voter) {
                Vote::factory()->create([
                    'user_id' => $voter->id,
                    'item_id' => $item->id,
                ]);
            }
        });
    }
}
