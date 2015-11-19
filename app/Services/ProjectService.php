<?php

namespace Project\Services;

use Prettus\Validator\Exceptions\ValidatorException;
use Project\Repositories\ProjectRepository;
use Project\Validators\ProjectValidator;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;
    /**
     * @var ProjectValidator
     */
    private $validator;
    /**
     * @var ProjectMemberRepository
     */
    private $memberRepository;

    public function __construct( ProjectRepository $repository, ProjectValidator $validator, ProjectMemberRepository $memberRepository )
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->memberRepository = $memberRepository;
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

    public function addMember($projectId, $memberId)
    {
        try {
            $project = $this->repository->find($projectId);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => "Project {$projectId} not found",
            ];
        }

        $project->members()->attach($memberId);
    }

    public function removeMember($projectId, $memberId)
    {
        try {
            $project = $this->repository->find($projectId);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => "Project {$projectId} not found",
            ];
        }
        $project->members()->detach($memberId);
    }

    public function isMember($projectId, $memberId)
    {
        $project = $this->memberRepository->findWhere(['project_id' => $projectId, 'user_id' => $memberId]);
        if (count($project)){
            return true;
        }
        return false;
    }

}