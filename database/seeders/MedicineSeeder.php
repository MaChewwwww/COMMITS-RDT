<?php

namespace Database\Seeders;

use App\Models\Boxes;
use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all boxes
        $boxes = Boxes::all();

        // Create medicines for each box
        foreach ($boxes as $box) {
            Medicine::factory()->create([
                'box_id' => $box->id
            ]);
        }
    }
}