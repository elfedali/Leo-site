<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Node;
use App\Models\NodeMeta;

class NodeMetaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NodeMeta::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'node_id' => Node::factory(),
            'meta_key' => $this->faker->word(),
            'meta_value' => $this->faker->word(),
        ];
    }
}
