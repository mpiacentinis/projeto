<?php

namespace Project\Services;

use Prettus\Validator\Exceptions\ValidatorException;
use Project\Repositories\ProjectFileRepository;
use Project\Repositories\ProjectMemberRepository;
use Project\Repositories\ProjectRepository;
use Project\Validators\ProjectValidator;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Filesystem\Factory as Storage;

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
    /**
     * @var Storage
     */
    private $storage;
    /**
     * @var ProjectFileRepository
     */
    private $fileRepository;

    public function __construct( ProjectRepository $repository, ProjectValidator $validator, ProjectMemberRepository $memberRepository, Storage $storage, ProjectFileRepository $fileRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->memberRepository = $memberRepository;
        $this->storage = $storage;
        $this->fileRepository = $fileRepository;
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

        $projectMember = $this->memberRepository->findWhere(['project_id' => $projectId, 'user_id' => $memberId ]);
        if (count($projectMember) == null ) {
            return [
                'error' => true,
                'message' => "Membro {$memberId} não encontrado no Projeto {$projectId}",
            ];
        }
        foreach( $projectMember as $members ){
            $this->memberRepository->delete( $members->id );
        }

        return [
            'message' => "Membro {$memberId} removido do  Projeto {$projectId}",
        ];

    }


    public function isMember($projectId, $memberId)
    {
        $project = $this->memberRepository->findWhere(['project_id' => $projectId, 'user_id' => $memberId]);
        if (count($project) >= 1 ){
            return [
                'message' => "Membro {$memberId} encontrado no Projeto {$projectId}",
            ];
        }
        return [
            'error' => true,
            'message' => "Membro {$memberId} não encontrado no Projeto {$projectId}",
        ];
    }

    public function createFile(array $data)
    {
        $project = $this->repository->skipPresenter()->find( $data['project_id']);
        $project->files()->create($data);
        $this->storage->put($data['name'].".".$data['extension'], File::get($data['file']));
    }

    public function deleteFile($id)
    {
        $project = $this->repository->skipPresenter()->find( $id );
        $fileUpload = $project->files;

        foreach( $fileUpload as $file )
        {
            $arquivo = $file->name.".".$file->extension;
            $this->storage->delete($arquivo);
            $this->fileRepository->delete($file->id);

        }
    }
}