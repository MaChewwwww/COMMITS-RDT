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
            'stock_number' => str_pad($this->faker->unique()->numberBetween(0, 99), 2, '0', STR_PAD_LEFT) . '-' . str_pad($this->faker->unique()->numberBetween(0, 999), 3, '0', STR_PAD_LEFT),
            'isReturned' => false,
            'supplier_name' => $this->faker->randomElement(['United Laboratories (Unilab)', 'Mercury Drug Corporation', 'RiteMED', 'Pascual Laboratories']),
            'user_id' => 1
        ];
    }
}
