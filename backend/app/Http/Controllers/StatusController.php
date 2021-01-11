<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StatusRepositoryEloquent;

class StatusController extends Controller
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * @var $responseCode
     */
    protected $responseCode = 200;

    public function __construct(StatusRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     *
     * @var \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'search'            =>  'nullable|string',
        ]);

        $data = $this->repository->all();

        return response()->json($data,$this->responseCode);
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
