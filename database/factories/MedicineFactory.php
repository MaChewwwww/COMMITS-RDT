<?php

namespace Database\Factories;

use App\Models\Boxes;
use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class MedicineFactory extends Factory
{
    protected $model = Medicine::class;

    public function definition(): array
    {
        $initialQuantity = $this->faker->numberBetween(50, 1000);
        $consumedQuantity = $this->faker->numberBetween(0, $initialQuantity);
        $remainingQuantity = $initialQuantity - $consumedQuantity;

        // Define status based on quantities
        $status = match(true) {
            $remainingQuantity === $initialQuantity => 'Full',
            $remainingQuantity === 0 => 'Out of Stock',
            $remainingQuantity <= ($initialQuantity * 0.2) => 'Low Stock',
            default => 'In Stock',
        };

        return [
            'medicine_name' => $this->faker->randomElement([
                'Paracetamol 500mg',
                'Amoxicillin 500mg',
                'Mefenamic 500mg',
                'Cetirizine 10mg',
                'Vitamin C 500mg',
                'Ibuprofen 400mg'
            ]),
            'unit' => $this->faker->randomElement(['tablet', 'capsule', 'bottle', 'box']),
            'initial_quantity' => $initialQuantity,
            'consumed_quantity' => $consumedQuantity,
            'remaining_quantity' => $remainingQuantity,
            'expiration_date' => $this->faker->dateTimeBetween('now', '+2 years'),
            'box_id' => Boxes::factory(),
            'status' => $status,
            'user_id' => function (array $attributes) {
                return Boxes::find($attributes['box_id'])->user_id;
            }
        ];
    }

    public function expired(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'expiration_date' => Carbon::now()->subDays(rand(1, 365)),
            ];
        });
    }

    public function lowStock(): static
    {
        return $this->state(function (array $attributes) {
            $initialQuantity = $attributes['initial_quantity'];
            $remainingQuantity = ceil($initialQuantity * 0.15);
            return [
                'consumed_quantity' => $initialQuantity - $remainingQuantity,
                'remaining_quantity' => $remainingQuantity,
                'status' => 'Low Stock'
            ];
        });
    }

    public function outOfStock(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'consumed_quantity' => $attributes['initial_quantity'],
                'remaining_quantity' => 0,
                'status' => 'Out of Stock'
            ];
        });
    }
}