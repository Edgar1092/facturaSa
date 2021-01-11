<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Repositories\ClientRepositoryEloquent;

use DB;

class ClientController extends Controller
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
     * @var $is_prospect
     */
    protected $is_prospect;

    public function __construct(ClientRepositoryEloquent $repository)
    {
        $this->repository = $repository;

        switch( Route::getFacadeRoot()->current()->uri() )
        {
            case 'api/prospects':
                $this->is_prospect = true;
                break;

            default:
                $this->is_prospect = false;
                break;
        }
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
        ]);

        $per_page = (!empty($request->per_page)) ? $request->per_page : $this->repository->count();

        if( $this->is_prospect == 'prospect' )
        {
            $this->repository->pushCriteria(\App\Criteria\ProspectCriteria::class);
        }else{
            $this->repository->pushCriteria(\App\Criteria\ClientCriteria::class);
        }

        $resp = $this->repository->with([
            'credit_cards',
            'country',
            'payment_method',
            'quotations.status'    =>  function($q){
                $q->where('name','Aprobada');
            }
        ])
        ->paginate($per_page);

        return response()->json($resp,$this->responseCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClientCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientCreateRequest $request)
    {

        DB::beginTransaction();
        $client = [];
        try{
            $client = $this->repository->create(
                $request->except(['is_prospect'])
                +
                [
                    'is_prospect'   =>  $this->is_prospect,
                    'date_client'   =>  (!$this->is_prospect) ? date('Y-m-d H:i:s') : null,
                    'date_prospect' =>  ($this->is_prospect) ? date('Y-m-d H:i:s') : null,
                ]

            );
            if(!empty($request->credit_cards))
            {
                foreach( $request->credit_cards as $card )
                {
                    if( !empty($card) )
                    {
                        $client->credit_cards()->create([
                            'card_number'           =>  $card['card_number'],
                            'expiration_year'       =>  $card['expiration_year'],
                            'expiration_month'      =>  $card['expiration_month'],
                        ]);
                    }

                }
            }

            $client->load('country','credit_cards','parent');

            $message = 'Registro Exitoso!';
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }


        return response()->json([
            'message'   =>  $message,
            'data'      =>  $client,
        ],$this->responseCode);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = [];
        try{
            $client = $this->repository->find($id);
            $client->load('country','credit_cards','parent');

        }catch(\Exception $e){
            $this->responseCode = 404;
        }

        return response()->json($client,$this->responseCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ClientUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request, $id)
    {
        $client = [];
        DB::beginTransaction();
        try{
            $client = $this->repository->find($id);
            $client->fill( $request->except(['type','date_client','date_prospect']) );
            $client->save();
            $cardsIds = [];
            if( !empty($request->credit_cards) )
            {
                foreach( $request->credit_cards as $card )
                {

                    $credit_card = $client->credit_cards()->updateOrCreate([
                        'id'        =>  $card['id']
                    ],
                    [
                        'card_number'           =>  $card['card_number'],
                        'expiration_year'       =>  $card['expiration_year'],
                        'expiration_month'      =>  $card['expiration_month'],
                    ]);
                    array_push($cardsIds, $credit_card->id);
                }
            }
            $client->credit_cards()->whereNotIn('id', $cardsIds)->delete();
            $client->load('country','credit_cards','parent');
            $message = 'Registro Actualizado!';
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 404;
        }


        return response()->json([
            'data'      =>  $client,
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
            $client = $this->repository->find($id);
            $client->delete();
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
