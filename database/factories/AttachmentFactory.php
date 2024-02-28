<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Attachment;
use App\Models\User;

class AttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attachment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'uploadedby_id' => User::factory(),
            'title' => $this->faker->sentence(4),
            'path' => $this->faker->word(),
            'mime_type' => $this->faker->word(),
            'size' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
