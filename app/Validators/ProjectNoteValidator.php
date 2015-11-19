<?php


namespace Project\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{
    protected $rules = [

        'project_id'     => 'required|integer',
        'note'          => 'required',
        'title'      => 'required',
    ];
}