<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Boxes>
 */
class BoxesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_received' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'box_name' => 'Box ' . $this->faker->unique()->numberBetween(1000, 9999),
            'description' => $this->faker->sentence(),
            'status' => 'Full',
            'supplier_name' => $this->faker->company(),
            'user_id' => 1
        ];
    }
}
