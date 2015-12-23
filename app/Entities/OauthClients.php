<?php

namespace Project\Entities;

use Exception;
use Illuminate\Database\Eloquent\Model;

class OauthClients extends Model
{
    //
    protected $fillable = [
        'id',
        'secret',
        'name'
    ];

}

