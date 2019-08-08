<?php

use App\Stock;
use Illuminate\Database\Seeder;

class StockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Stock::truncate();

        $faker = \Faker\Factory::create();
        for ($i = 0; $i <= 100; $i++) {
            Stock::create([
                'code_no' => $faker->randomNumber,
                'stock_name' => $faker->sentence(3, true),
                'project_id' => 'project1',
                'from_date' => $faker->date,
                'to_date' => $faker->date,
                'is_avaliable' => 1,
            ]);
        }
    }
}
