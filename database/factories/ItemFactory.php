<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    private array $itemTitles = [
        'Electronics' => ['Old laptop', 'Working TV', 'Vintage radio', 'Desktop monitor', 'Computer keyboard', 'USB cables', 'Phone charger', 'Bluetooth speaker'],
        'Furniture' => ['Wooden desk', 'Office chair', 'Bookshelf', 'Coffee table', 'Dining chairs set', 'Nightstand', 'Small dresser', 'Shoe rack'],
        'Clothing' => ['Winter jacket', 'Formal shirts', 'Jeans collection', 'Running shoes', 'Handbag', 'Scarf set', 'Business suit', 'Vintage dresses'],
        'Books' => ['Novel collection', 'Textbooks', 'Cookbook set', 'Comic books', 'Magazine stack', 'Encyclopedia set', 'Children books', 'Mystery novels'],
        'Sports & Outdoors' => ['Yoga mat', 'Dumbbells', 'Bicycle', 'Camping tent', 'Hiking backpack', 'Tennis racket', 'Soccer ball', 'Skateboard'],
        'Toys & Games' => ['Board games', 'Lego sets', 'Stuffed animals', 'Puzzle collection', 'Action figures', 'Doll house', 'Remote control car', 'Building blocks'],
        'Home & Garden' => ['Plant pots', 'Garden tools', 'Flower vases', 'Picture frames', 'Wall clock', 'Throw pillows', 'Curtains', 'Area rug'],
        'Kitchen' => ['Pots and pans', 'Blender', 'Coffee maker', 'Dish set', 'Cutlery set', 'Toaster', 'Food containers', 'Mixing bowls'],
        'Baby & Kids' => ['Stroller', 'Baby clothes', 'High chair', 'Baby toys', 'Car seat', 'Crib bedding', 'Baby monitor', 'Kid\'s bicycle'],
        'Art & Crafts' => ['Paint supplies', 'Sewing machine', 'Yarn collection', 'Craft paper', 'Beading kit', 'Canvas set', 'Scrapbook supplies', 'Drawing pencils'],
        'Musical Instruments' => ['Acoustic guitar', 'Keyboard', 'Violin', 'Drum sticks', 'Music stand', 'Microphone', 'Harmonica', 'Ukulele'],
        'Pet Supplies' => ['Dog bed', 'Cat tree', 'Fish tank', 'Pet carrier', 'Dog toys', 'Bird cage', 'Pet bowls', 'Leash set'],
    ];

    private array $cities = [
        'New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix',
        'Philadelphia', 'San Antonio', 'San Diego', 'Dallas', 'Austin',
        'Seattle', 'Denver', 'Boston', 'Portland', 'Miami',
    ];

    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();
        $categoryName = $category?->name ?? 'Electronics';
        $titles = $this->itemTitles[$categoryName] ?? $this->itemTitles['Electronics'];

        return [
            'user_id' => User::factory(),
            'category_id' => $category?->id ?? Category::factory(),
            'title' => fake()->randomElement($titles),
            'description' => fake()->paragraphs(rand(2, 4), true),
            'city' => fake()->randomElement($this->cities),
            'weight' => fake()->optional(0.3)->randomFloat(2, 0.1, 50),
            'dimensions' => fake()->optional(0.3)->regexify('[0-9]{1,2}x[0-9]{1,2}x[0-9]{1,2} cm'),
            'status' => fake()->randomElement(['available', 'available', 'available', 'gifted']), // 75% available
        ];
    }

    public function available(): static
    {
        return $this->state(fn () => ['status' => 'available']);
    }

    public function gifted(): static
    {
        return $this->state(fn () => ['status' => 'gifted']);
    }
}
