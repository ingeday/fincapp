<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $name  = $faker->name;
        DB::table('users')->insert([
            'name' => $name,
            'email' => 'admin@fincalaturquesa.com',
            'password' => bcrypt('secret'),
        ]);

    }
}
