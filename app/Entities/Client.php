<?php

namespace Project\Entities;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
        'name',
        'responsible',
        'email',
        'phone',
        'address',
        'obs'
    ];

    public function project()
    {
        return $this->hasMany( Project::class);
    }
}

