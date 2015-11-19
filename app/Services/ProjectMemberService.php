<?php

namespace Project\Services;

use Prettus\Validator\Exceptions\ValidatorException;
use Project\Repositories\ProjectMemberRepository;
use Project\Validators\ProjectMemberValidator;

class ProjectMemberService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;
    /**
     * @var ProjectValidator
     */
    private $validator;

    public function __construct( ProjectMemberRepository $repository, ProjectMemberValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create( array $data )
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch ( ValidatorException $e ) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public function update( array $data, $id )
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id );
        } catch ( ValidatorException $e ) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }
}