<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PatientRecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patient_records')->insert([
            [
                'patient_name' => 'John Doe',
                'status' => 'healed',
                'identity' => 'faculty',
                'start_date' => Carbon::parse('2024-11-20')->format('Y-m-d'), // November 20, 2024
                'discharge_date' => Carbon::parse('2024-12-01')->format('Y-m-d'), // December 1, 2024
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_name' => 'Jane Smith',
                'status' => 'ongoing',
                'identity' => 'admin',
                'start_date' => Carbon::parse('2024-10-15')->format('Y-m-d'), // October 15, 2024
                'discharge_date' => Carbon::parse('2024-12-01')->format('Y-m-d'), // Ongoing case, no discharge date
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_name' => 'Robert Brown',
                'status' => 'healed',
                'identity' => 'student',
                'start_date' => Carbon::parse('2024-09-10')->format('Y-m-d'), // September 10, 2024
                'discharge_date' => Carbon::parse('2024-11-25')->format('Y-m-d'), // November 25, 2024
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
