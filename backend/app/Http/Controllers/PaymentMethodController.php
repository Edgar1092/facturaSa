<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PaymentMethodRepositoryEloquent;
use DB;

class PaymentMethodController extends Controller
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * @var $responseCode
     */
    protected $responseCode = 200;

    /**
     * @var $type_client
     */
    protected $type_client;

    public function __construct(PaymentMethodRepositoryEloquent $repository)
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
        return response()->json($this->repository->all(),$this->responseCode);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment_method = [];
        try{
            $payment_method = $this->repository->find($id);
        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($payment_method,$this->responseCode);
    }

}
