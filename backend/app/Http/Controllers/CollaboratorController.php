<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CollaboratorCreateRequest;
use App\Http\Requests\CollaboratorUpdateRequest;
use App\Repositories\CollaboratorRepositoryEloquent;
use App\Repositories\StatusRepositoryEloquent;
use DB;
use Auth;

class CollaboratorController extends Controller
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * @var $statusRepo
     */
    protected $statusRepo;

    /**
     * @var $responseCode
     */
    protected $responseCode = 200;

    public function __construct(CollaboratorRepositoryEloquent $repository,
    StatusRepositoryEloquent $statusRepo)
    {
        $this->repository = $repository;
        $this->statusRepo = $statusRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = (!empty($request->per_page)) ? $request->per_page : $this->repository->count();

        $this->repository->pushCriteria(\App\Criteria\CollaboratorCriteria::class);

        $resp = $this->repository
        ->with(['status','blood_type'])
        ->paginate($per_page);

        return response()->json($resp,$this->responseCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollaboratorCreateRequest $request)
    {
        DB::beginTransaction();
        $collaborator = [];
        try{
            $collaborator = $this->repository->create($request->all());

            $collaborator->load('status');

            $message = 'Registro Exitoso!';
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $collaborator,
        ],$this->responseCode);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collaborator = [];

        try{
            $collaborator = $this->repository->find($id);
            $collaborator->load(['status','blood_type']);

        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($collaborator,$this->responseCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CollaboratorUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        $collaborator = [];
        try{

            $collaborator = $this->repository->find($id);

            $collaborator->fill( $request->all() );

            $collaborator->save();
            $collaborator->load('status');

            $message = 'Registro Actualizado!';
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $collaborator,
        ],$this->responseCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $client = $this->repository->find($id);
            $client->delete();
            $message = 'Registro Eliminado!';
        }catch(\Exception $e){
            $message = 'Recurso no encontrado';
            $this->responseCode = 404;
        }

        return response()->json([
            'message'   =>  $message,
        ],$this->responseCode);
    }


}
