<?php


namespace Project\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [

        'owner_id'      => 'required',
        'client_id'     => 'required',
        'name'          => 'required|max:255',
        'progress'      => 'required|numeric',
        'status'        => 'required|numeric',
        'due_date'      => 'required|date'
    ];
}