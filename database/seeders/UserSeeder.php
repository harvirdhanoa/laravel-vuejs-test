<?php

namespace Database\Seeders;
use App\Models\User;
use Faker\Generator as Faker;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $users = [
            [
                'name'=> $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('Password')
            ],
            [
                'name'=> $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('Password')
            ],
            [
                'name'=>  $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('Password')
            ],
            [
                'name'=>  $faker->name,
                'email' =>  $faker->email,
                'password' => bcrypt('Password')
            ],
            [
                'name'=>  'test user',
                'email' =>  'laravelvue@mail.com',
                'password' => bcrypt('Password')
            ]             
        ];
        
        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
