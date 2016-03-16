<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        User::create([
        'name' => "user",
        'email' => "user@user.com",
        'password' => Hash::make("password"),
        ]);

        User::create([
            'name' => "root",
            'email' => "root@root.com",
            'password' => Hash::make("root"),
        ]);


    }
}
