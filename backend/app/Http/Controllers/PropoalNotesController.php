<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Requests\PropoalNoteCreateRequest;
use App\Http\Requests\PropoalNoteUpdateRequest;
use App\Repositories\PropoalNoteRepositoryEloquent;
use DB;
use Auth;

class PropoalNotesController extends Controller
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * @var $responseCode
     */
    protected $responseCode = 200;



    public function __construct(PropoalNoteRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'per_page'      =>  'nullable|integer',
            'page'          =>  'nullable|integer',
            'text'          =>  'nullable|string',
            'order_type'    =>  'nullable|in:desc,asc'
        ]);

        $per_page = (!empty($request->per_page)) ? $request->per_page : $this->repository->count();
        $this->repository->pushCriteria(\App\Criteria\PropoalNoteCriteria::class);
        $resp = $this->repository->paginate($per_page);

        return response()->json($resp,$this->responseCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PropoalNoteCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropoalNoteCreateRequest $request)
    {
        DB::beginTransaction();
        $note = [];
        try{
            $note = $this->repository->create($request->all()+[
                'user_id'   =>  Auth::user()->id
            ]);
            $files = $request->input('files');
            $syncData = [];

            if( !empty($files) )
            {
                $pivotData = array_fill(0, count($files), ['table_name' => $note->getTable()]);
                $syncData  = array_combine($files, $pivotData);
            }

            $note->files()->sync($syncData);

            $note->load('propoal','files');
            $message = 'Registro Exitoso!';
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $note,
        ],$this->responseCode);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = [];
        try{
            $note = $this->repository->with('propoal','files')->find($id);
        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($note,$this->responseCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PropoalNoteCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(PropoalNoteUpdateRequest $request, $id)
    {
        $note = [];
        DB::beginTransaction();
        try{
            $note = $this->repository->find($id);
            $note->fill( $request->all() );
            $note->save();
            $files = $request->input('files');
            $syncData = [];

            if( !empty($files) )
            {
                $pivotData = array_fill(0, count($files), ['table_name' => $note->getTable()]);
                $syncData  = array_combine($files, $pivotData);
            }

            $note->files()->sync($syncData);
            $note->load('files','propoal');

            $message = 'Registro Actualizado!';
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 404;
        }

        return response()->json([
            'data'      =>  $note,
            'message'   =>  $message,
        ],$this->responseCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $note = $this->repository->find($id);
            $note->delete();
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
