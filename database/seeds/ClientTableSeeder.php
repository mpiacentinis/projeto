<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Project\Client::truncate();
        factory( \Project\Client::class , 10 )->create();
    }
}
