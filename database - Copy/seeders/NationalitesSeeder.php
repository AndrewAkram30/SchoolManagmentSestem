<?php

namespace Database\Seeders;

use App\Models\nationalites;
use App\Models\reliagion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           DB::table('nationalites')->delete();

        $Nationalites = [

  'Afghan',
  'Egyption',
  'lebanon',
  'Sadi arabia',
  'Albanian',
  'Aland Islander',
  'Algerian',
  'American Samoan',
  'Andorran',
  'Angolan',
  'Anguillan',
  'Antarctican',
  'Antiguan',
  'Argentinian',

        ];

          foreach ($Nationalites as $N) {
            nationalites::create(['Name' => $N]);
        }
    }
}

