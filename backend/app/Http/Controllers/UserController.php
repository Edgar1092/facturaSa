<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Repositories\UserRepositoryEloquent;
use App\Models\User;
use DB;

class UserController extends Controller
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * @var $responseCode
     */
    protected $responseCode = 200;

    public function __construct(UserRepositoryEloquent $repository)
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
            'search'        =>  'nullable|string',
            'orderBy'       =>  'nullable|string',
            'sortBy'        =>  'nullable|in:desc,asc'
        ]);

        $per_page = (!empty($request->per_page)) ? $request->per_page : $this->repository->count();
        $this->repository->pushCriteria(app('App\Criteria\RoleCriteria'));
        $resp = $this->repository->with('roles')->paginate( $per_page);

        return response()->json($resp,$this->responseCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        DB::beginTransaction();
        $user = [];
        try{
            $user = $this->repository->create(
                $request->all()
            );
            $user->save();
            $rol= [1];
            $user->roles()->sync( $rol);
            $message = 'Registro Exitoso!';
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $user->load('roles'),
        ],$this->responseCode);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = [];
        try{
            $user = $this->repository->with(['roles'])->find($id);

        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($user,$this->responseCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserCreateRequest $request, $id)
    {
        $user = [];
        DB::beginTransaction();
        try{
            $user = $this->repository->find($id);
            $user->fill( $request->all() );
            $user->save();

            $user->roles()->sync($request->roles);

            $message = 'Registro Actualizado!';
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 404;
        }

        return response()->json([
            'data'      =>  $user->load('roles'),
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
            $user = $this->repository->find($id);
            $user->delete();
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
