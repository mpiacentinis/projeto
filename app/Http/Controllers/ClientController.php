<?php

namespace Project\Http\Controllers;

use Illuminate\Http\Request;
use Project\Entities\Client;
use Project\Entities\Project;
use Project\Repositories\ClientRepository;
use Project\Services\ClientService;

class ClientController extends Controller
{
    private $repository;
    /**
     * @var ClientService
     */
    private $service;

    /**
     * @param ClientRepository $repository
     * @param ClientService $service
     */
    public function __construct( ClientRepository $repository, ClientService $service)
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
        return $this->repository->all();
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
        return  $this->repository->findWhere(['id' => $id ]);
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
