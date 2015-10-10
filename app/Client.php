<?php

namespace Project;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
        'name',
        'responsible',
        'email'.
        'phohe',
        'address',
        'obs'
    ];
}
