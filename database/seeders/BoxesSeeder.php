<?php

namespace Database\Seeders;

use App\Models\Boxes;
use App\Models\User;
use Illuminate\Database\Seeder;

class BoxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assuming you have a user with ID 1
        $user = User::find(1);

        // Create boxes for the user
        Boxes::factory()
            ->count(10)
            ->create([
                'user_id' => $user->id
            ]);
    }
}