<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OfficeCreateRequest;
use App\Repositories\OfficeRepositoryEloquent;

class OfficeController extends Controller
{
    /**
     * @var $repository
     */
    protected $repository;

    public function __construct(OfficeRepositoryEloquent $repository)
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
            'order_by'      =>  'nullable|string|in:name,contact,email,zip_code,phone_1,phone_2,city,street,colony,observation',
            'order_type'    =>  'nullable|in:desc,asc'
        ]);

        $per_page = (!empty($request->per_page)) ? $request->per_page : $this->repository->count();

        $resp = $this->repository->paginate($per_page);

        return response()->json($resp,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\OfficeCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficeCreateRequest $request)
    {
        $office = $this->repository->create(
            $request->all()
        );

        return response()->json([
            'message'   =>  'Registro Exitoso!',
            'data'      =>  $office,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $office = [];
        $code = 200;
        try{
            $office = $this->repository->find($id);

        }catch(\Exception $e){

            $code = 404;
        }
        return response()->json($office,$code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\OfficeCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(OfficeCreateRequest $request, $id)
    {
        $office = [];
        try{
            $office = $this->repository->find($id);
            $office->fill( $request->all() );
            $office->save();
            $message = 'Registro Actualizado!';
            $responseCode = 200;
        }catch(\Exception $e){
            $message = $exception->getMessage();
            $responseCode = 404;
        }

        return response()->json([
            'data'      =>  $office,
            'message'   =>  $message,
        ],$responseCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $office = $this->repository->find($id);
            $office->delete();
            $message = 'Registro Eliminado!';
            $responseCode = 200;
        }catch(\Exception $e){
            $message = $e->getMessage();
            $responseCode = 404;
        }

        return response()->json([
            'message'   =>  $message,
        ],$responseCode);

    }
}
