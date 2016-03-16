<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(OrderListSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(ProductAvailabilitySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(ShiftSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PreferenceSeeder::class);

        Model::reguard();
    }
}
