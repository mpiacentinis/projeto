<?php

namespace Project\Http\Controllers;

use Illuminate\Http\Request;
use Project\Repositories\ProjectMemberRepository;
use Project\Repositories\ProjectRepository;
use Project\Services\ProjectService;

class ProjectController extends Controller
{
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;

    /**
     * @param ProjectRepository $repository
     * @param ProjectService $service
     */
    public function __construct( ProjectRepository $repository, ProjectService $service )
    {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(  )
    {
        //return $this->repository->all();
        return  $this->repository->with(['owner', 'client'])->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return  $this->repository->with(['owner', 'client'])->findWhere(['id' => $id]);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if ( count( self::show($id) ) == 0 ) {
            return [
                'error' => true,
                'message' => 'Nao encontrado'
            ];
        } else {
            if ( count($this->repository->with('notes')->find($id)) > 0 ) {
                return [
                    'error' => true,
                    'message' => 'Este Projeto tem Notas'
                ];
            } else {
                return $this->repository->delete( $id);
            }

        }


    }

    /**
     * @param $id
     * @return Response
     */
    public function showMembers($id)
    {
        return $this->repository->with('member')->findWhere(['id' => $id ]);
    }

    /**
     * @param $id
     * @param $memberId
     * @return Response
     */
    public function addMember($id, $memberId)
    {
        return $this->repository->addMember($id, $memberId);
    }
    /**
     * @param $id
     * @param $memberId
     * @return Response
     */
    public function removeMember($id, $memberId)
    {
        if ( count( self::show($id) ) == 0 ) {
            return [
                'error' => true,
                'message' => 'Nao encontrado'
            ];
        } else {
            if ( count($this->repository->with(['project'])->findWhere(['id' => $id])) > 0 ) {
                return [
                    'error' => true,
                    'message' => 'Este Cliente tem Projetos'
                ];
            } else {
                return $this->repository->delete( $id);
            }
        }
    }

}
