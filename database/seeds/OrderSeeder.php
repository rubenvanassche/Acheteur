<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->truncate();

        DB::table('orders')->insert([
            'id' => 1,
            'event_id' => 1,
            'name' => "customerBBQ1.1",
            'email' => "customer@customer.com",
            'comments' => "None",
            'shift_id' => '1'
        ]);

        DB::table('orders')->insert([
            'id' => 2,
            'event_id' => 1,
            'name' => "customerBBQ1.2",
            'email' => "customer@customer.com",
            'comments' => "None",
            'shift_id' => '1'
        ]);

        DB::table('orders')->insert([
            'id' => 3,
            'event_id' => 1,
            'name' => "customerBBQ2.1",
            'email' => "customer@customer.com",
            'comments' => "None",
            'shift_id' => '2'
        ]);

        DB::table('orders')->insert([
            'id' => 4,
            'event_id' => 1,
            'name' => "customerBBQ2.2",
            'email' => "customer@customer.com",
            'comments' => "None",
            'shift_id' => '2'
        ]);

        DB::table('orders')->insert([
            'id' => 5,
            'event_id' => 1,
            'name' => "customerBBQ3.1",
            'email' => "customer@customer.com",
            'comments' => "None",
            'shift_id' => '3'
        ]);

        DB::table('orders')->insert([
            'id' => 6,
            'event_id' => 1,
            'name' => "customerBBQ3.2",
            'email' => "customer@customer.com",
            'comments' => "None",
            'shift_id' => '3'
        ]);

        DB::table('orders')->insert([
            'id' => 7,
            'event_id' => 2,
            'name' => "customerKaas1",
            'email' => "customer@customer.com",
            'comments' => "None",
            'shift_id' => '4'
        ]);

        DB::table('orders')->insert([
            'id' => 8,
            'event_id' => 2,
            'name' => "customerKaas2",
            'email' => "customer@customer.com",
            'comments' => "None",
            'shift_id' => '4'
        ]);
    }
}
