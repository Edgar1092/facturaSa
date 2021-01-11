<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Repositories\TaskRepositoryEloquent;
use DB;
use Auth;

class TaskController extends Controller
{
/**
     * @var $repository
     */
    protected $repository;

    /**
     * @var $responseCode
     */
    protected $responseCode = 200;

    public function __construct(TaskRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = (!empty($request->per_page)) ? $request->per_page : $this->repository->count();

        $resp = $this->repository
        ->with(['client','propoal.status','status','task_type','files']);
        return response()->json($resp->paginate($per_page), $this->responseCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TaskCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCreateRequest $request)
    {

        DB::beginTransaction();

        try{

            $task = $this->repository->create(
                $request->all() + [
                    'owner_user_id' =>  Auth::user()->id
                ]
            );

            $files = $request->input('files');
            $syncData = [];

            if( !empty($files) )
            {
                $pivotData = array_fill(0, count($files), ['table_name' => $task->getTable()]);
                $syncData  = array_combine($files, $pivotData);
            }

            $task->files()->sync($syncData);

            $task->load('client','propoal.status','status','task_type','files','owner');

            $message = 'Registro Exitoso!';
            DB::commit();
        }catch(\Exception $e){
            $task = [];
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $task,
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
        $task = [];

        try{
            $task = $this->repository->find($id);
            $task->load('client','propoal.status','status','task_type','files','owner');

        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($task,$this->responseCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try{

            $task = $this->repository->find($id);
            $task->fill( $request->except(['owner_user_id']));
            $files = $request->input('files');
            $syncData = [];

            if( !empty($files) )
            {
                $pivotData = array_fill(0, count($files), ['table_name' => $task->getTable()]);
                $syncData  = array_combine($files, $pivotData);
            }

            $task->files()->sync($syncData);

            $task->load('client','propoal.status','status','task_type','files','owner');

            $message = 'Registro Actualizado!';
            DB::commit();
        }catch(\Exception $e){
            $task = [];
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $task,
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
            $task = $this->repository->find($id);
            $task->delete();
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
