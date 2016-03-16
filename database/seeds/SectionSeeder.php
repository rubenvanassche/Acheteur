<?php

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->truncate();

        DB::table('sections')->insert([
            'id' => 1,
            'page_id' => 1,
            'type' => "trevor",
            'name' => 'content',
            'slug' => 'content',
            'content' => "BBQbla"
        ]);

        DB::table('sections')->insert([
            'id' => 2,
            'page_id' => 2,
            'type' => "trevor",
            'name' => 'content',
            'slug' => 'content',
            'content' => "Kaasbla"
        ]);
    }
}
