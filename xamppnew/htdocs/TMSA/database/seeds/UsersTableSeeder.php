<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Osita',
            'email' => 'osita@gmail.com',
            'userAccessLevel' => '0',
            'password' => bcrypt('password'),
        ]);
    }
}
