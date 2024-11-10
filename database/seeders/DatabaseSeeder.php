<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(BloodSeeder::class);
        $this->call(NationalitesSeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(SettingTableSeeder::class);


        user::create([
            'name' => 'andrew akram',
            'email' => 'andrew@test.com',
            'password' => '123456',
        ]);
    }
}
