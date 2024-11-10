<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specializations')->delete();
        $Specialization = [
            'Arabic',
            'English',
            'science',
            'Math',
        ];

        foreach ($Specialization as $specialization) {
            Specialization::create(['Name' => $specialization]);
        }
    }
}
