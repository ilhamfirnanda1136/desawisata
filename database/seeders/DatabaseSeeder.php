<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

use Illuminate\Support\Str;

use DB,Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        DB::table('users')->insert([
            'name' => 'admindpd',
            'email'=>$faker->email,
            'username' => 'dpdjatim',
            'password'=> Hash::make('dpdjatim'),
            'pusat_id' => 15,
            'level'=> 2,
        ]);
    }
}
