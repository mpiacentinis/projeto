<?php

use Illuminate\Database\Seeder;
use Project\Entities\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        factory( User::class , 10 )->create(
            [
                'name' => 'Marinnho Piacentinis',
                'email' => 'mpiacentinis@gmail.com',
                'password' => bcrypt('19190610@mps'),
                'remember_token' => str_random(10),
            ]
        );
        factory( User::class , 10 )->create();
    }
}
