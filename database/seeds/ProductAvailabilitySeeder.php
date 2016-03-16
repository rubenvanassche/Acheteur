<?php

use Illuminate\Database\Seeder;

class ProductAvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_availability')->truncate();

        DB::table('product_availability')->insert([
            'id' => 1,
            'product_id' => 1,
            'shift_id' => 1,
            'available' => 20,
            'sold' => 3
        ]);

        DB::table('product_availability')->insert([
            'id' => 2,
            'product_id' => 2,
            'shift_id' => 1,
            'available' => 10,
            'sold' => 4
        ]);

        DB::table('product_availability')->insert([
            'id' => 3,
            'product_id' => 1,
            'shift_id' => 2,
            'available' => 40,
            'sold' => 5
        ]);

        DB::table('product_availability')->insert([
            'id' => 4,
            'product_id' => 2,
            'shift_id' => 2,
            'available' => 20,
            'sold' => 6
        ]);

        DB::table('product_availability')->insert([
            'id' => 5,
            'product_id' => 1,
            'shift_id' => 3,
            'available' => 80,
            'sold' => 7
        ]);

        DB::table('product_availability')->insert([
            'id' => 6,
            'product_id' => 2,
            'shift_id' => 3,
            'available' => 40,
            'sold' => 8
        ]);

        DB::table('product_availability')->insert([
            'id' => 7,
            'product_id' => 3,
            'shift_id' => 1,
            'available' => 20,
            'sold' => 3
        ]);

        DB::table('product_availability')->insert([
            'id' => 8,
            'product_id' => 4,
            'shift_id' => 1,
            'available' => 10,
            'sold' => 4
        ]);
    }
}
