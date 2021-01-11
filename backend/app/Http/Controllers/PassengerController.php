<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PassengerRepositoryEloquent;
use App\Http\Requests\PassengerCreateRequest;
use App\Http\Requests\PassengerUpdateRequest;
use App\Exports\ViewExport;
use Excel;
use PDF;
use DB;

class PassengerController extends Controller
{
/**
     * @var $repository
     */
    protected $repository;

    /**
     * @var $responseCode
     */
    protected $responseCode = 200;

    public function __construct(PassengerRepositoryEloquent $repository)
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

        $this->repository->pushCriteria(\App\Criteria\PassengerCriteria::class);

        $resp = $this->repository->with([
            'nationalities',
            'emergency_contacts'
        ])
        ->paginate($per_page);

        return response()->json($resp,$this->responseCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PassengerCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PassengerCreateRequest $request)
    {
        DB::beginTransaction();
        try{
            $passenger = $this->repository->create(
                $request->all() + [
                    'user_id'       =>  $request->user()->id
                ]
            );

            $files = $request->input('files');
            $syncData = [];

            if( !empty($files) )
            {
                $pivotData = array_fill(0, count($files), ['table_name' => $passenger->getTable()]);
                $syncData  = array_combine($files, $pivotData);
            }
            $passenger->files()->sync($syncData);


            foreach( $request->nationalities as $i => $nationalityRequest )
            {
                $passenger->nationalities()->create(
                [
                    'country_id'                =>  $nationalityRequest['country_id'],
                    'passport'                  =>  $nationalityRequest['passport'],
                    'passport_expiration_date'  =>  $nationalityRequest['passport_expiration_date'],
                    'visa'                      =>  $nationalityRequest['visa'],
                    'visa_expiration_date'      =>  $nationalityRequest['visa_expiration_date'],
                    'ine'                       =>  $nationalityRequest['ine'],
                    'curp'                      =>  $nationalityRequest['curp'],

                ]);
            }

            foreach( $request->emergency_contacts as $i => $contact )
            {
                $passenger->emergency_contacts()->create(
                [
                    'first_name'    =>  $contact['first_name'],
                    'last_name'     =>  $contact['last_name'],
                    'email'         =>  $contact['email'],
                    'phone_1'       =>  $contact['phone_1'],
                    'phone_2'       =>  $contact['phone_2']

                ]);
            }
            $passenger->load('country','nationalities.country','emergency_contacts','files');
            $message = 'Registro Exitoso!';
            DB::commit();
        }catch(\Exception $e){
            $passenger = [];
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $passenger,
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
        $passenger = [];

        try{
            $passenger = $this->repository
            ->with(['country','nationalities.country','emergency_contacts','files'])
            ->find($id);

        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($passenger,$this->responseCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PassengerUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PassengerUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try{
            $passenger = $this->repository->find( $id );
            $passenger->fill( $request->all() );
            $passenger->save();

            $files = $request->input('files');
            $syncData = [];

            if( !empty($files) )
            {
                $pivotData = array_fill(0, count($files), ['table_name' => $passenger->getTable()]);
                $syncData  = array_combine($files, $pivotData);
            }
            $passenger->files()->sync($syncData);

            $nationalitiesIds = [];
            foreach( $request->nationalities as $i => $nationalityRequest )
            {
                $nationality = $passenger->nationalities()->updateOrcreate(
                [
                    'passenger_id'              =>  $passenger->id,
                    'id'                        =>  $nationalityRequest['id']
                ],
                [
                    'country_id'                =>  $nationalityRequest['country_id'],
                    'passport'                  =>  $nationalityRequest['passport'],
                    'passport_expiration_date'  =>  $nationalityRequest['passport_expiration_date'],
                    'visa'                      =>  $nationalityRequest['visa'],
                    'visa_expiration_date'      =>  $nationalityRequest['visa_expiration_date'],
                    'ine'                       =>  $nationalityRequest['ine'],
                    'curp'                      =>  $nationalityRequest['curp'],

                ]);

                array_push($nationalitiesIds, $nationality->id);
            }
            $passenger->nationalities()->whereNotIn('id',$nationalitiesIds)->delete();

            $emergencyContactsIds = [];
            foreach( $request->emergency_contacts as $i => $contact )
            {
                $emergency_contact = $passenger->emergency_contacts()->updateOrcreate(
                [
                    'id'            =>  $contact['id']
                ],
                [
                    'first_name'    =>  $contact['first_name'],
                    'last_name'     =>  $contact['last_name'],
                    'email'         =>  $contact['email'],
                    'phone_1'       =>  $contact['phone_1'],
                    'phone_2'       =>  $contact['phone_2']

                ]);
                array_push($emergencyContactsIds, $emergency_contact->id);
            }

            $passenger->emergency_contacts()->whereNotIn('id', $emergencyContactsIds)->delete();


            $passenger->load(['country','nationalities.country','emergency_contacts','files']);

            $message = 'Registro Actualizado!';

            DB::commit();
        }catch(\Exception $e){
            $passenger = [];
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $passenger,
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
            $passenger = $this->repository->find($id);
            $passenger->delete();
            $message = 'Registro Eliminado!';
        }catch(\Exception $e){
            $message = 'Recurso no encontrado';
            $this->responseCode = 404;
        }

        return response()->json([
            'message'   =>  $message,
        ],$this->responseCode);
    }

    public function export(Request $request, $id)
    {
        $passenger = $this->repository
        ->find($id);

        $params =  [

            'passenger'      =>  $passenger,
            'view'           => 'reports.excel.passenger'
        ];

        switch( $request->format )
        {
            case 'pdf':
                $pdf = PDF::loadView('reports.pdf.passenger', $params)
                ->setOption('margin-top', 16)
                ->setOption('margin-bottom', 16)
                ->setOption('margin-right', 16)
                ->setOption('margin-left', 16);
                return $pdf->inline('passenger.pdf');
                break;

            case 'excel':
                return Excel::download(
                    new ViewExport (
                        $params
                    ),
                    'passenger.xlsx'
                );
                break;

            default:
                return response()->json($client,200);
            break;
        }
    }
}
