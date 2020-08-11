<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      =>  'Usuario 1',
            'email'     =>  'pessoa@gmail.com',
            'phone'     =>  '16984567319',
            'password' =>  bcrypt('123456'),

        ]);
        // $this->call(UserSeeder::class);
    }
}
