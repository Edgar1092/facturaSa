<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PropoalCreateRequest;
use App\Http\Requests\PropoalUpdateRequest;
use App\Repositories\PropoalRepositoryEloquent;
use App\Repositories\StatusRepositoryEloquent;
use DB;
use Auth;

class PropoalController extends Controller
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

    public function __construct(PropoalRepositoryEloquent $repository,
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

        $this->repository->pushCriteria(\App\Criteria\PropoalCriteria::class);

        $resp = $this->repository->with([
            'client',
            'status',
            'files'
        ])
        ->withCount('quotations')
        ->withCount('notes')
        ->withCount('tasks')
        ->paginate($per_page);

        return response()->json($resp,$this->responseCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropoalCreateRequest $request)
    {

        DB::beginTransaction();
        $propoal = [];
        try{
            $status = $this->statusRepo->findWhere([
                'type'  =>  'propoals',
                'name'  =>  'abierta'
            ])->first();
            $propoal = $this->repository->new($request->all());

            $lastPropoal = $this->repository->orderBy('created_at','desc')
            ->findWhere(['office_id' => $request->office_id])->first();

            if(!empty($lastPropoal) && isset($lastPropoal->folio))
            {

                $folio = sprintf("%08d", intval($lastPropoal->folio)+1);
            }else{
                $folio = sprintf("%08d", 1);
            }

            $propoal->owner_user_id = Auth::user()->id;
            $propoal->status_id = $status->id;
            $propoal->folio = $folio;
            $propoal->save();
            $files = $request->input('files');
            $syncData = [];

            if( !empty($files) )
            {
                $pivotData = array_fill(0, count($files), ['table_name' => $propoal->getTable()]);
                $syncData  = array_combine($files, $pivotData);
            }

            $propoal->files()->sync($syncData);

            $propoal->load('client.country','status','quotations.status','notes','files');

            $message = 'Registro Exitoso!';
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $propoal,
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
        $propoal = [];

        try{
            $propoal = $this->repository->find($id);
            $propoal->load('client.country','status','quotations.status','notes','files','owner');

        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($propoal,$this->responseCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropoalUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        $propoal = [];
        try{

            $propoal = $this->repository->whereHas('status', function($q){
                $q->whereIn('name',['Abierta','Borrador','Vencida','Rechazada']);
            })
            ->find($id);

            $propoal->fill( $request->all() );

            $propoal->save();

            $files = $request->input('files');
            $syncData = [];

            if( !empty($files) )
            {
                $pivotData = array_fill(0, count($files), ['table_name' => $propoal->getTable()]);
                $syncData  = array_combine($files, $pivotData);
            }

            $propoal->files()->sync($syncData);

            $propoal->load('client.country','status','quotations.status','files');

            $message = 'Registro Actualizado!';
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $propoal,
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
