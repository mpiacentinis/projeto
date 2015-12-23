<?php

use Illuminate\Database\Seeder;
use Project\Entities\OauthClients;

class OauthClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OauthClients::truncate();
        factory( OauthClients::class )->create(
            [
                'id' => 'exemplo',
                'name' => 'sistema',
                'secret' => 'projeto',
            ]
        );
    }
}
