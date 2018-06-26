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
        $user  = new \App\Models\User();
        $faker = Faker::create();
        
        $users = [
            [
                'name'     => 'The First Patron',
                'email'    => 'patron@patron.com',
                'password' => '123456',
                'verified' => 1,
                'role'     => 'patron',
                'details'  => [
                    'about'    => $faker->paragraph,
                    'birthday' => $faker->date('Y-m-d'),
                    'website'  => $faker->url,
                    'location' => 'paris'
                ]
            ],
            [
                'name'     => 'The Second Patron',
                'email'    => 'patron2@patron.com',
                'password' => '123456',
                'verified' => 1,
                'role'     => 'patron',
                'details'  => [
                    'about'    => $faker->paragraph,
                    'birthday' => $faker->date('Y-m-d'),
                    'website'  => $faker->url,
                    'location' => 'paris'
                ]
            ],
        ];
        
        foreach ($users as $item) {
            $user->create($item);
        }
    }
}
