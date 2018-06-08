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
        $user = new \App\Models\User();
        
        $users = [
            [
                'name'     => 'The Artist',
                'email'    => 'artist@artist.com',
                'password' => '123456',
                'verified' => 1,
                'role'     => 'artist'
            ],
            [
                'name'     => 'The Patron',
                'email'    => 'patron@patron.com',
                'password' => '123456',
                'verified' => 1,
                'role'     => 'patron'
            ],
        ];
        
        foreach($users as $item) {
            $user->create($item);
        }
    }
}
