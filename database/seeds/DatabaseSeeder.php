<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StockTableSeeder::class);
        $this->call(EstimateTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
    }
}
