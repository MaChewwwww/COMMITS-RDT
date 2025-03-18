<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\Boxes;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        // First create all boxes needed
        $boxes = Boxes::factory()->count(8)->create();
        
        // Create medicines using existing boxes
        foreach ($boxes as $index => $box) {
            if ($index < 3) {
                Medicine::factory()->state(['box_id' => $box->id, 'user_id' => $box->user_id])->create();
            } elseif ($index < 5) {
                Medicine::factory()->expired()->state(['box_id' => $box->id, 'user_id' => $box->user_id])->create();
            } elseif ($index < 7) {
                Medicine::factory()->lowStock()->state(['box_id' => $box->id, 'user_id' => $box->user_id])->create();
            } else {
                Medicine::factory()->outOfStock()->state(['box_id' => $box->id, 'user_id' => $box->user_id])->create();
            }
        }
    }
}