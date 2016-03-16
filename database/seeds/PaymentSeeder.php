<?php

use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->truncate();

        DB::table('payments')->insert([
            'id' => 1,
            'order_id' => 1,
            'type' => "cash",
            'amount' => 12
        ]);

        DB::table('payments')->insert([
            'id' => 2,
            'order_id' => 1,
            'type' => "cash",
            'amount' => 12
        ]);

        DB::table('payments')->insert([
            'id' => 3,
            'order_id' => 1,
            'type' => "bank",
            'amount' => 10
        ]);

        DB::table('payments')->insert([
            'id' => 4,
            'order_id' => 2,
            'type' => "cash",
            'amount' => 12
        ]);

        DB::table('payments')->insert([
            'id' => 5,
            'order_id' => 2,
            'type' => "cash",
            'amount' => 12
        ]);

        DB::table('payments')->insert([
            'id' => 6,
            'order_id' => 2,
            'type' => "bank",
            'amount' => 10
        ]);
    }
}
