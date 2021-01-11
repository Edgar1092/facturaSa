<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CurrencyRepositoryEloquent;
use DB;
use Auth;

class CurrencyController extends Controller
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

    public function __construct(CurrencyRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resp = $this->repository->all();
        return response()->json($resp, $this->responseCode);
    }

}
