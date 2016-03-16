<?php

use Illuminate\Database\Seeder;

class OrderListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orderlists')->truncate();

        // Shift 1
            // Order 1
            DB::table('orderlists')->insert([
                'product_id' => 1,
                'order_id' => 1,
                'amount' => 1
            ]);

            DB::table('orderlists')->insert([
                'product_id' => 2,
                'order_id' => 1,
                'amount' => 1
            ]);

            // Order 2
            DB::table('orderlists')->insert([
                'product_id' => 1,
                'order_id' => 2,
                'amount' => 2
            ]);

            DB::table('orderlists')->insert([
                'product_id' => 2,
                'order_id' => 2,
                'amount' => 3
            ]);

        // Shift 2
            // Order 3
            DB::table('orderlists')->insert([
                'product_id' => 1,
                'order_id' => 3,
                'amount' => 1
            ]);

            DB::table('orderlists')->insert([
                'product_id' => 2,
                'order_id' => 3,
                'amount' => 1
            ]);

            // Order 4
            DB::table('orderlists')->insert([
                'product_id' => 1,
                'order_id' => 4,
                'amount' => 4
            ]);

            DB::table('orderlists')->insert([
                'product_id' => 2,
                'order_id' => 4,
                'amount' => 5
            ]);

        // Shift 3
            // Order 5
            DB::table('orderlists')->insert([
                'product_id' => 1,
                'order_id' => 5,
                'amount' => 1
            ]);

            DB::table('orderlists')->insert([
                'product_id' => 2,
                'order_id' => 5,
                'amount' => 1
            ]);

            // Order 6
            DB::table('orderlists')->insert([
                'product_id' => 1,
                'order_id' => 6,
                'amount' => 6
            ]);

            DB::table('orderlists')->insert([
                'product_id' => 2,
                'order_id' => 6,
                'amount' => 7
            ]);

        // Order 7
        DB::table('orderlists')->insert([
            'product_id' => 3,
            'order_id' => 7,
            'amount' => 1
        ]);

        DB::table('orderlists')->insert([
            'product_id' => 4,
            'order_id' => 7,
            'amount' => 1
        ]);

        // Order 8
        DB::table('orderlists')->insert([
            'product_id' => 3,
            'order_id' => 8,
            'amount' => 2
        ]);

        DB::table('orderlists')->insert([
            'product_id' => 4,
            'order_id' => 8,
            'amount' => 3
        ]);
    }

}
