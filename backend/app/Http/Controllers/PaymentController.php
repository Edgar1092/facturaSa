<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PaymentRepositoryEloquent;
use App\Repositories\StatusRepositoryEloquent;
use App\Http\Requests\PaymentCreateRequest;
use App\Http\Requests\PaymentUpdateRequest;
use App\Exports\ViewExport;
use DB;
use PDF;

class PaymentController extends Controller
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

    public function __construct(PaymentRepositoryEloquent $repository, StatusRepositoryEloquent $statusRepo)
    {
        $this->repository = $repository;
        $this->statusRepo = $statusRepo;
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
            'until'         =>  'nullable|date_format:Y-m-d',
            'since'         =>  'nullable|date_format:Y-m-d',
        ]);

        $per_page = (!empty($request->per_page)) ? $request->per_page : $this->repository->count();


        $this->repository->pushCriteria(\App\Criteria\PaymentCriteria::class);

        $resp = $this->repository
        ->with(['client','quotation','payment_method','user','files'])
        ->paginate($per_page);
        return response()->json($resp, $this->responseCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PaymentCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentCreateRequest $request)
    {
        DB::beginTransaction();
        try{
            $payment = $this->repository->create(
                $request->all() + [
                    'user_id'       =>  $request->user()->id
                ]
            );

            $files = $request->input('files');
            $syncData = [];

            if( !empty($files) )
            {
                $pivotData = array_fill(0, count($files), ['table_name' => $payment->getTable()]);
                $syncData  = array_combine($files, $pivotData);
            }

            $payment->files()->sync($syncData);

            if($payment->quotation->total <= $payment->quotation->payments->sum('import')){
                $status = $this->statusRepo->findWhere([
                    'type'  =>  'quotations',
                    'name'  =>  'Aprobada y pagada'
                ])->first();
                $payment->quotation->status_id = $status->id;
                $payment->quotation->save();
            }
            $payment->load('client','quotation','payment_method','currency','user','files');
            $message = 'Registro Exitoso!';
            DB::commit();
        }catch(\Exception $e){
            $payment = [];
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $payment,
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
        $patment = [];

        try{
            $patment = $this->repository->find($id);
            $patment->load('client','quotation','payment_method','user','files');

        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($patment,$this->responseCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PaymentUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try{
            $payment = $this->repository->find( $id );
            $payment->fill( $request->all() );
            $files = $request->input('files');
            $syncData = [];

            if( !empty($files) )
            {
                $pivotData = array_fill(0, count($files), ['table_name' => $payment->getTable()]);
                $syncData  = array_combine($files, $pivotData);
            }

            $payment->files()->sync($syncData);
            $payment->save();
            $payment->load('client','quotation','payment_method','currency','user','files');
            $message = 'Registro Actualizado!';

            DB::commit();
        }catch(\Exception $e){
            $payment = [];
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $payment,
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
            $payment = $this->repository->find($id);
            if($payment->import>0)
            {
                $status = $this->statusRepo->findWhere([
                    'type'  =>  'quotations',
                    'name'  =>  'Aprobada'
                ])->first();
            }

            $payment->quotation->status_id = $status->id;
            $payment->quotation->save();

            $payment->delete();

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
        $request->validate([
            'format'        =>  'required|in:pdf,excel'
        ]);
        $payment = $this->repository->with([
            'client',
            'quotation',
            'payment_method',
            'currency',
            'user',
            'files'
        ])->find($id);

        $params =  [
            'payment'   =>  $payment,
            'view'      =>  'reports.excel.payment'
        ];

        switch( $request->format )
        {
            case 'pdf':
                $pdf = PDF::loadView('reports.pdf.payment', $params)
                ->setOption('margin-top', 16)
                ->setOption('margin-bottom', 16)
                ->setOption('margin-right', 16)
                ->setOption('margin-left', 16);
                return $pdf->inline('payment.pdf');
                break;

            case 'excel':
                return Excel::download(
                    new ViewExport (
                        $params
                    ),
                    'client_quotations.xlsx'
                );
                break;

            default:
                return response()->json($client,200);
            break;
        }
    }
}
