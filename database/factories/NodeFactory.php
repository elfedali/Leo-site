<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Node;
use App\Models\User;

class NodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Node::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $user =  User::inRandomOrder()->first();
        return [
            'uuid' => $this->faker->uuid(),
            'owner_id' => $user->id,
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->paragraphs(3, true),
            'excerpt' => $this->faker->text(),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'type' => $this->faker->randomElement(['shop', 'restaurant', 'hotel', 'event']),
            'review_status' => $this->faker->randomElement(['open', 'closed']),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'website' => $this->faker->url(),
            'address' => $this->faker->address(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'open_time' => $this->faker->time(),
            'close_time' => $this->faker->time(),
            'price_from' => $this->faker->randomFloat(2, 10, 1000),
            'price_to' => $this->faker->randomFloat(2, 1000, 10000),
            'currency' => $this->faker->randomElement(['MAD', 'USD', 'EUR']),
            'capacity' => $this->faker->numberBetween(10, 100),
            'rating' => $this->faker->randomFloat(1, 0, 5),
            'featured' => $this->faker->boolean(),

        ];
    }
}
