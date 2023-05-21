<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Clear data
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Report::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Insert some test data

        $faker = Faker::create();

        Report::create([
            'name' => "Bob",
            'long' => $faker->longitude(),
            'lat' => $faker->latitude(),
        ]);

        $faker = Faker::create();

        Report::create([
            'name' => "Charlie",
            'long' => $faker->longitude(),
            'lat' => $faker->latitude(),
        ]);

        $faker = Faker::create();

        Report::create([
            'name' => "David",
            'long' => $faker->longitude(),
            'lat' => $faker->latitude(),
        ]);
    }
}
