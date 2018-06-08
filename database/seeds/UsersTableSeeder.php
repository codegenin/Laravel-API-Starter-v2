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
                'name'     => 'The Artist',
                'email'    => 'artist@artist.com',
                'password' => '123456',
                'verified' => 1,
                'role'     => 'artist',
                'about'    => $faker->paragraph,
                'birthday' => $faker->date('Y-m-d'),
                'website'  => $faker->url
            ],
            [
                'name'     => 'The Patron',
                'email'    => 'patron@patron.com',
                'password' => '123456',
                'verified' => 1,
                'role'     => 'patron',
                'about'    => $faker->paragraph,
                'birthday' => $faker->date('Y-m-d'),
                'website'  => $faker->url
            ],
        ];
        
        foreach ($users as $item) {
            $user->create($item);
        }
    }
}
