<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();

        DB::table('products')->insert([
            'id' => 1,
            'event_id' => 1,
            'name' => "BBQ Volwassene",
            'description' => "Een grote maaltijd",
            'slug' => "bbqVolwassene",
            'price' => 12
        ]);

        DB::table('products')->insert([
            'id' => 2,
            'event_id' => 1,
            'name' => "BBQ Kind",
            'description' => "Een kleine maaltijd",
            'slug' => "bbqKind",
            'price' => 10
        ]);

        DB::table('products')->insert([
            'id' => 3,
            'event_id' => 2,
            'name' => "Kaas Volwassene",
            'description' => "Een grote maaltijd",
            'slug' => "kaasVolwassene",
            'price' => 12
        ]);

        DB::table('products')->insert([
            'id' => 4,
            'event_id' => 2,
            'name' => "Kaas Kind",
            'description' => "Een kleine maaltijd",
            'slug' => "kaasKind",
            'price' => 10
        ]);
    }
}
