<?php

namespace Project\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Project\Entities\Client;

class ClientRepositoryEloquent extends  BaseRepository implements ClientRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        // TODO: Implement model() method.
        return Client::class;
    }

}