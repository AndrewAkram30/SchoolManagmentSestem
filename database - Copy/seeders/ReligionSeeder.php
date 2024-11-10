<?php

namespace Database\Seeders;

use App\Models\reliagion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           DB::table('reliagions')->delete();

        $Reliagions = [

           'Christian','Muslim','Other',

        ];

        foreach ($Reliagions as $Religion) {
            reliagion::create(['Name' => $Religion]);
        }
    }
}
