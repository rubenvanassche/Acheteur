<?php

use App\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->truncate();

        $event = new Event;
        $event->id = 1;
        $event->name = "BBQ";
        $event->slug = "bbq";
        $event->email = "rubenvanassche@bbq.com";
        $event->password = Hash::make("password");
        $event->shifts = 1;

        $event->save();

        $event2 = new Event;
        $event2->id = 2;
        $event2->name = "Kaas";
        $event2->slug = "kaas";
        $event2->email = "rubenvanassche@kaas.com";
        $event2->password = Hash::make("password");
        $event2->shifts = 0;

        $event2->save();

    }
}
