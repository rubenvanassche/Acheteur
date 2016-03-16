<?php

use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('shifts')->truncate();

        DB::table('shifts')->insert([
            'id' => 1,
            'event_id' => 1,
            'start' => '2015-05-16 18:00:00',
            'end' => '2015-05-16 20:00:00'
        ]);

        DB::table('shifts')->insert([
            'id' => 2,
            'event_id' => 1,
            'start' => '2015-05-16 20:00:00',
            'end' => '2015-05-16 22:00:00'
        ]);

        DB::table('shifts')->insert([
            'id' => 3,
            'event_id' => 1,
            'start' => '2015-05-16 22:00:00',
            'end' => '2015-05-17 00:00:00'
        ]);

        DB::table('shifts')->insert([
            'id' => 4,
            'event_id' => 2,
            'start' => '2015-05-16 22:00:00',
            'end' => '2015-05-17 00:00:00'
        ]);
    }
}
