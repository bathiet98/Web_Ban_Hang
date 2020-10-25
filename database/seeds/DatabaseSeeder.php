<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        \DB::table('admins')->insert([
            'name'      => 'NGUYEN BA THIET',
            'email'     => 'admin@gmail.com',
            'phone'     => '0372293187',
            'address'   => 'Bắc Ninh',
            'password'  => Hash::make('123456789')
        ]);
    }
}
