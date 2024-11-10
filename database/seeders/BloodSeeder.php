<?php

namespace Database\Seeders;

use App\Models\Type_Blood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type__bloods')->delete();
         $Type_Bloods=['A+','A-','B+', 'B-','O+','O-','AB'];

        foreach ($Type_Bloods as  $Type_Blood) {
           Type_Blood::create(['Name'=> $Type_Blood]);
        }
    }
}
