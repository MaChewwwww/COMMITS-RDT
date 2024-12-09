<?php

namespace Database\Factories;

use App\Models\Boxes;
use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicineFactory extends Factory
{
    protected $model = Medicine::class;

    public function definition(): array
    {
        $initialQuantity = $this->faker->randomFloat(2, 1, 1000);
        $consumedQuantity = $this->faker->randomFloat(2, 0, $initialQuantity);
        
        return [
            'medicine_name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'unit_of_measurement' => $this->faker->randomElement(['tablets', 'ml', 'mg', 'capsules']),
            'initial_quantity' => $initialQuantity,
            'consumed_quantity' => $consumedQuantity,
            'remaining_quantity' => $initialQuantity - $consumedQuantity,
            'expiration_date' => $this->faker->dateTimeBetween('now', '+2 years'),
            'box_id' => Boxes::factory(),
        ];
    }
}
