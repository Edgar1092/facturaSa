<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreditCardCreateRequest;
use App\Http\Requests\CreditCardUpdateRequest;
use App\Repositories\CreditCardRepositoryEloquent;
use DB;

class CreditCardController extends Controller
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * @var $responseCode
     */
    protected $responseCode = 200;

    public function __construct(CreditCardRepositoryEloquent $repository)
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
        ]);

        $per_page = (!empty($request->per_page)) ? $request->per_page : $this->repository->count();

        $resp = $this->repository->paginate($per_page);

        return response()->json($resp,$this->responseCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreditCardCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreditCardCreateRequest $request)
    {
        DB::beginTransaction();
        $creditCard = [];
        try{
            $creditCard = $this->repository->create(
                $request->all()
            );

            $message = 'Registro Exitoso!';
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $creditCard,
        ],$this->responseCode);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $creditCard = [];
        try{
            $creditCard = $this->repository->find($id);
            $creditCard->load('client');

        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($creditCard,$this->responseCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CreditCardCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(CreditCardUpdateRequest $request, $id)
    {
        $creditCard = [];
        DB::beginTransaction();
        try{
            $creditCard = $this->repository->find($id);
            $creditCard->fill( $request->all() );
            $creditCard->save();

            $creditCard->nationalities()->sync( $request->nationalities );

            $creditCard->load('client');

            $message = 'Registro Actualizado!';
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 404;
        }

        return response()->json([
            'data'      =>  $creditCard,
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
            $creditCard = $this->repository->find($id);
            $creditCard->delete();
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
