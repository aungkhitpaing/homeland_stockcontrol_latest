<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::truncate();

        $faker = \Faker\Factory::create();
        for ($i = 0; $i <= 100; $i++) {
            Supplier::create([
                'project_name' => $faker->sentence(3, true),
                'type' => $faker->randomElement(['unit1', 'unit2', 'unit3']),
                'quantity' => $faker->randomElement(['1', '2', '3']),
                'pay_amount' => $faker->randomElement(['10000', '20000', '30000']),
                'left_amount' => $faker->randomElement(['400', '500', '600']),

            ]);
        }
    }
}
