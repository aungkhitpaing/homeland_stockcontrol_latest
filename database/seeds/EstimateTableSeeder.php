<?php

use App\Estimate;
use Illuminate\Database\Seeder;

class EstimateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Estimate::truncate();

        $faker = \Faker\Factory::create();
        for ($i = 0; $i <= 100; $i++) {
            Estimate::create([
                'type' => $faker->sentence(3, true),
                'unit' => $faker->randomElement(['unit1', 'unit2', 'unit3']),
                'price' => $faker->randomElement(['10000', '20000', '30000']),
                'quantity' => $faker->randomElement(['1', '2', '3']),
            ]);
        }
    }
}
