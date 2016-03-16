<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->truncate();

        DB::table('pages')->insert([
            'id' => 1,
            'event_id' => 1,
            'title' => "HomeBBQ",
            'slug' => "home",
            'home' => '1'
        ]);

        \Illuminate\Support\Facades\Storage::put('resources/views/events/bbq/front/home.blade.php', '');

        DB::table('pages')->insert([
            'id' => 2,
            'event_id' => 2,
            'title' => "HomeKaas",
            'slug' => "home",
            'home' => '1'
        ]);

        \Illuminate\Support\Facades\Storage::put('resources/views/events/kaas/front/home.blade.php', '');

        DB::table('pages')->insert([
            'id' => 3,
            'event_id' => 1,
            'title' => "test",
            'slug' => "test",
            'home' => '0'
        ]);

        \Illuminate\Support\Facades\Storage::put('resources/views/events/bbq/front/test.blade.php', '');

        DB::table('pages')->insert([
            'id' => 4,
            'event_id' => 2,
            'title' => "test",
            'slug' => "test",
            'home' => '0'
        ]);

        \Illuminate\Support\Facades\Storage::put('resources/views/events/kaas/front/test.blade.php', '');
    }
}
