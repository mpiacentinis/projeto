<?php

namespace Project\Http\Controllers;

use Illuminate\Http\Request;
use Project\Repositories\ProjectNoteRepository;
use Project\Services\ProjectNoteService;

class ProjectNoteController extends Controller
{
    private $repository;
    /**
     * @var ProjectNoteService
     */
    private $service;

    /**
     * @param ProjectNoteRepository $repository
     * @param ProjectNoteService $service
     */
    public function __construct( ProjectNoteRepository $repository, ProjectNoteService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $id )
    {
        return  $this->repository->findWhere(['project_id' => $id ]);
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
    public function show($id, $noteId)
    {
        return  $this->repository->findWhere(['project_id' => $id, 'id' => $noteId ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $noteId )
    {
        return $this->service->update($request->all(), $noteId );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $noteId )
    {

        if ( count( self::show($id, $noteId) ) == 0 ) {
            return [
                'error' => true,
                'message' => 'Nao encontrado'
            ];
        } else {
            return $this->repository->delete( $noteId);
        }



    }
}
