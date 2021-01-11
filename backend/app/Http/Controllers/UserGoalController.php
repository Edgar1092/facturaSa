<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Requests\UserGoalCreateRequest;
use App\Http\Requests\UserGoalUpdateRequest;
use App\Repositories\UserGoalRepositoryEloquent;
use App\Repositories\StatusRepositoryEloquent;
use DB;

class UserGoalController extends Controller
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * @var $responseCode
     */
    protected $responseCode = 200;



    public function __construct(UserGoalRepositoryEloquent $repository, StatusRepositoryEloquent $statusRepository)
    {
        $this->repository = $repository;
        $this->statusRepository = $statusRepository;
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
            'order_by'      =>  'nullable|string|in:name,contact,email,zip_code,phone_1,phone_2,city,street,colony,observation',
            'order_type'    =>  'nullable|in:desc,asc'
        ]);

        $per_page = (!empty($request->per_page)) ? $request->per_page : $this->repository->count();

        $resp = $this->repository->with([
            'user',
            'status'
        ])->paginate($per_page);

        return response()->json($resp,$this->responseCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserGoalCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserGoalCreateRequest $request)
    {
        DB::beginTransaction();
        $user_goal = [];
        try{
            $status = $this->statusRepository->findWhere([
                'type'      =>  'goals',
                'name'      =>  'Pendiente'
            ])->first();
            $user_goal = $this->repository->create(
                $request->except('status_id') + [
                    'status_id'     => $status->id
                ]);
            $user_goal->load('user','status');
            $message = 'Registro Exitoso!';
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $user_goal,
        ],$this->responseCode);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_goal = [];
        try{
            $user_goal = $this->repository->with(['user','status'])->find($id);
        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($user_goal,$this->responseCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserGoalCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserGoalUpdateRequest $request, $id)
    {
        $user_goal = [];
        DB::beginTransaction();
        try{
            $user_goal = $this->repository->find($id);
            $user_goal->fill( $request->except(['office_id','status_id']) );
            $user_goal->save();
            $user_goal->load(['user','status']);
            $message = 'Registro Actualizado!';
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 404;
        }

        return response()->json([
            'data'      =>  $user_goal,
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
            $user_goal = $this->repository->find($id);
            $user_goal->delete();
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
