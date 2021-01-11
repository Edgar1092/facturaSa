<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TaskTypeRepositoryEloquent;

class TaskTypeController extends Controller
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * @var $responseCode
     */
    protected $responseCode = 200;

    public function __construct(TaskTypeRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resp = $this->repository->all();
        return response()->json($resp,$this->responseCode);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = [];
        try{
            $country = $this->repository->find($id);

        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($country,$this->responseCode);
    }

}
