<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleRepositoryEloquent;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use DB;

class RoleController extends Controller
{
/**
     * @var $repository
     */
    protected $repository;

    /**
     * @var $responseCode
     */
    protected $responseCode = 200;

    public function __construct(RoleRepositoryEloquent $repository)
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
        $request->validate([
            'per_page'      =>  'nullable|integer',
            'page'          =>  'nullable|integer',
            'search'        =>  'nullable|string',
        ]);

        $per_page = (!empty($request->per_page)) ? $request->per_page : $this->repository->count();

        $this->repository->pushCriteria(\App\Criteria\RoleCriteria::class);

        $resp = $this->repository->with([
            'permissions',
        ])
        ->paginate($per_page);

        return response()->json($resp,$this->responseCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {
        DB::beginTransaction();
        try{
            $role = $this->repository->create(
                $request->only(['office_id','name'])
            );

            $role->permissions()->sync($request->permissions);
            $role->load('permissions');
            $message = 'Registro Exitoso!';
            DB::commit();
        }catch(\Exception $e){
            $role = [];
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $role,
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
        $role = [];

        try{
            $role = $this->repository
            ->with(['permissions'])
            ->find($id);

        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($role,$this->responseCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try{
            $role = $this->repository->find( $id );
            $role->fill( $request->only(['office_id','name']) );
            $role->permissions()->sync($request->permissions);
            $role->save();

            $role->load(['permissions']);

            $message = 'Registro Actualizado!';

            DB::commit();
        }catch(\Exception $e){
            $role = [];
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $role,
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
            $role = $this->repository->find($id);
            $role->delete();
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
