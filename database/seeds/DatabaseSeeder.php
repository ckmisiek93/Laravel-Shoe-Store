<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create('pl_PL');

    	/* ====================== Variables ====================== */

    	$password = 'qwerty';

    	/* ====================== Variables ====================== */


    	DB::table('users')->insert([
            'name' => 'Michal Kaleta',
            'email' => 'Michal.Kaleta@misiek.pl',
            'city' => 'Kielce',
            'adress' => 'Żelazna 15/15',
            'phone' => '333111333',
            'password' => bcrypt($password),
            'user_type' => 'Administrator',
            'created_at' => '2018-08-18 01:36:38',
            'updated_at' => '2018-08-18 01:36:38',
        ]);

    	DB::table('users')->insert([
            'name' => 'Misiek Kaleta',
            'email' => 'Misiek.Kaleta@misiek.pl',
            'city' => 'Kielce',
            'adress' => 'Żelazna 16/16',
            'phone' => '555111333',
            'password' => bcrypt($password),
            'user_type' => 'User',
            'created_at' => '2018-08-18 01:36:38',
            'updated_at' => '2018-08-18 01:36:38',
        ]);
    }
}