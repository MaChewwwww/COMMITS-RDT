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
        $initialQuantity = $this->faker->numberBetween(1, 1000);
        $consumedQuantity = $this->faker->numberBetween(0, $initialQuantity);
        $remainingQuantity = $initialQuantity - $consumedQuantity;
        
        $status = 'In Stock';
        if ($remainingQuantity == $initialQuantity) {
            $status = 'Full';
        } elseif ($remainingQuantity == 0) {
            $status = 'Out of Stock';
        } elseif ($remainingQuantity <= ($initialQuantity * 0.2)) {
            $status = 'Low Stock';
        }

        return [
            'medicine_name' => $this->faker->words(3, true),
            'unit' => $this->faker->randomElement(['tablets', 'ml', 'mg', 'capsules']),
            'status' => $status,
            'initial_quantity' => $initialQuantity,
            'consumed_quantity' => $consumedQuantity,
            'remaining_quantity' => $remainingQuantity,
            'expiration_date' => $this->faker->dateTimeBetween('now', '+2 years'),
            'box_id' => Boxes::factory(),
        ];
    }
}
