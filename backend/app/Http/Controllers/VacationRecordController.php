<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VacationRecordCreateRequest;
use App\Http\Requests\VacationRecordUpdateRequest;
use App\Repositories\VacationRecordRepositoryEloquent;
use App\Repositories\StatusRepositoryEloquent;
use DB;
use Auth;

class VacationRecordController extends Controller
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

    public function __construct(VacationRecordRepositoryEloquent $repository,
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

        $this->repository->pushCriteria(\App\Criteria\VacationRecordCriteria::class);

        $resp = $this->repository
        ->with('collaborator')
        ->paginate($per_page);

        return response()->json($resp,$this->responseCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacationRecordCreateRequest $request)
    {
        DB::beginTransaction();
        $vacation_record = [];
        try{
            $vacation_record = $this->repository->create($request->all());
            $vacation_record->load('collaborator');
            $message = 'Registro Exitoso!';
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $vacation_record,
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
        $vacation_record = [];

        try{
            $vacation_record = $this->repository->with('collaborator')->find($id);


        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($vacation_record,$this->responseCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VacationRecordUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        $vacation_record = [];
        try{

            $vacation_record = $this->repository->find($id);
            $vacation_record->fill( $request->all() );
            $vacation_record->save();
            $vacation_record->load('collaborator');

            $message = 'Registro Actualizado!';
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $vacation_record,
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


    public function events_calendar(Request $request)
    {
        $this->repository->pushCriteria(\App\Criteria\VacationRecordCriteria::class);

        $resp = $this->repository
        ->with('collaborator')
        ->all();

        return response()->json($resp,$this->responseCode);
    }
}
