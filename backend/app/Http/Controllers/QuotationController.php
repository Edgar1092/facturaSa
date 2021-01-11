<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuotationCreateRequest;
use App\Http\Requests\QuotationUpdateRequest;
use App\Repositories\QuotationRepositoryEloquent;
use App\Repositories\StatusRepositoryEloquent;
use App\Repositories\ServiceRepositoryEloquent;
use App\Exports\ViewExport;
use Carbon\Carbon;
use Auth;
use Excel;
use PDF;
use DB;

class QuotationController extends Controller
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
     * @var $serviceRepo
     */
    protected $serviceRepo;

    /**
     * @var $responseCode
     */
    protected $responseCode = 200;

    public function __construct(QuotationRepositoryEloquent $repository,
    StatusRepositoryEloquent $statusRepo, ServiceRepositoryEloquent $serviceRepo)
    {
        $this->repository = $repository;
        $this->statusRepo = $statusRepo;
        $this->serviceRepo = $serviceRepo;
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
            'until'         =>  'nullable|date_format:Y-m-d',
            'since'         =>  'nullable|date_format:Y-m-d',
            'start_date'    =>  'nullable|date_format:Y-m-d',
            'end_date'      =>  'nullable|date_format:Y-m-d',
        ]);

        $per_page = (!empty($request->per_page)) ? $request->per_page : $this->repository->count();

        $this->repository->pushCriteria(\App\Criteria\QuotationCriteria::class);

        $resp = $this->repository->with([
            'propoal.status',
            'client',
            'status',
            'files'
        ])
        ->paginate($per_page);

        return response()->json($resp,$this->responseCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuotationCreateRequest $request)
    {
        DB::beginTransaction();
        $quotation = [];

        try{
            $status = $this->statusRepo->findWhere([
                'type'  =>  'quotations',
                'name'  =>  'abierta'
            ])->first();

            $lastQuotation = $this->repository->whereHas('propoal',function($q) use($request){
                $q->where('office_id', $request->office_id);
            })->orderBy('created_at','desc')->first();
            if(!empty($lastQuotation) && isset($lastQuotation->folio))
            {
                $folio = sprintf("%08d", intval($lastQuotation->folio)+1);
            }else{
                $folio = sprintf("%08d", 1);
            }


            $quotation = $this->repository->new(
                $request->all() + [
                    'status_id' =>  $status->id,
                ]
            );
            $quotation->created_by_user_id = Auth::user()->id;
            $quotation->folio = $folio;
            $detail = [];
            $sub_total = 0;
            $total = 0;
            $quotation->save();
            $files = $request->input('files');
            $syncData = [];

            if( !empty($files) )
            {
                $pivotData = array_fill(0, count($files), ['table_name' => $quotation->getTable()]);
                $syncData  = array_combine($files, $pivotData);
            }
            $quotation->files()->sync($syncData);

            foreach( $request->details as $i => $detail_service )
            {
                $detail[$i] = $quotation->details()->create($detail_service);

                if( $detail_service['confirm'] == true && $detail[$i]->service->operator_commission == false)
                {
                    $sub_total += $detail_service['price'] * $detail_service['quantity'];
                }
            }

            $destinations = [];
            foreach( $request->destinations as $i => $destination )
            {
                $destinations[$i] = $quotation->destinations()->create($destination);
            }

            $quotation->sub_total = $sub_total;
            $quotation->tax_amount = $sub_total * ($quotation->tax/100);
            $quotation->total = $quotation->sub_total + $quotation->tax_amount;
            $quotation->save();

            $quotation->load('propoal.status','client.country','details.service','status','created_by');

            $message = 'Registro Exitoso!';
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $quotation,
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
        $quotation = [];

        try{
            $quotation = $this->repository
            ->with(['client','client','details.service','status','details','passengers','payments','files','created_by','rejected_or_authorized_by','destinations'])->find($id);
        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($quotation,$this->responseCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuotationUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        $quotation = [];
        try{

            $quotation = $this->repository->whereHas('status', function($q){
                $q->whereIn('name',['Abierta','Vencida','Rechazada','Aprobada']);
            })
            ->find($id);

            $quotation->fill( $request->all() );

            $files = $request->input('files');
            $syncData = [];

            if( !empty($files) )
            {
                $pivotData = array_fill(0, count($files), ['table_name' => $quotation->getTable()]);
                $syncData  = array_combine($files, $pivotData);
            }

            $quotation->files()->sync($syncData);

            if( empty($quotation->tax) )
            {
                $quotation->tax = 0;
            }

            $detail = [];
            $sub_total = 0;
            $total = 0;
            $detailsId = [];
            foreach( $request->details as $i => $detail_service )
            {
                $detail[$i] = $quotation->details()->updateOrcreate(
                    [
                        'id'                =>  $detail_service['id'],
                        'quotation_id'      =>  $quotation->id
                    ],
                    $detail_service
                );
                array_push($detailsId, $detail[$i]->id);
                if( $detail_service['confirm'] == true && $detail[$i]->service->operator_commission == false)
                {
                    $sub_total += $detail_service['price'] * $detail_service['quantity'];
                }

            }
            $quotation->details()->whereNotIn('id', $detailsId)->delete();


            $destinations = [];
            $destinationsId = [];
            foreach( $request->destinations as $i => $destination )
            {
                $destinations[$i] = $quotation->destinations()->updateOrcreate(
                    [
                        'id'                =>  $destination['id']
                    ],
                    $destination
                );
                array_push($destinationsId, $destinations[$i]->id);
            }
            $quotation->destinations()->whereNotIn('id', $destinationsId)->delete();


            $quotation->sub_total = $sub_total;
            $quotation->tax_amount = $sub_total * ($quotation->tax/100);
            $quotation->total = $quotation->sub_total + $quotation->tax_amount;
            $quotation->save();

            $quotation->load('propoal.status','client.country','details.service','status','files','created_by');


            $message = 'Registro Actualizado!';
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        return response()->json([
            'message'   =>  $message,
            'data'      =>  $quotation,
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

    /**
     * Approve the specified quotation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, $id)
    {
        $request->validate([
            'comment'           =>  'nullable|string',
        ]);
        $now = Carbon::now();
        try{
            $quotation = $this->repository->whereHas('status', function($q){
                $q->whereIn('name',['Abierta','Vencida','Rechazada']);
            })
            ->find($id);

            $quotation->load('passengers');
            $quotation->propoal->status_id = $this->statusRepo->findWhere([
                'type'      =>  'propoals',
                'name'      =>  'Aprobada'
            ])->first()->id;
            $quotation->propoal->approved_date = $now->format('Y-m-d H:i:s');
            $quotation->propoal->save();

            $quotation->status_id = $this->statusRepo->findWhere([
                'type'      =>  'quotations',
                'name'      =>  'Aprobada'
            ])->first()->id;
            $quotation->approved_date = $now->format('Y-m-d H:i:s');
            $quotation->comment = $request->comment;
            $quotation->rejected_or_authoryzed_by_user_id = Auth::user()->id;
            $quotation->save();
            $quotation->load('rejected_or_authorized_by');
            if( $quotation->client->is_prospect )
            {
                $client = $quotation->client;
                $client->is_prospect = false;
                $client->date_client = date('Y-m-d');
                $client->save();
            }
            $message = "Cotización Aprobada!";
        }catch(\Exception $e){
            DB::rollback();
            $quotation =  [];
            $message = $e->getMessage();
            $this->responseCode = 500;
        }
        $resp = [
            'data'          =>  $quotation,
            'message'       =>  $message
        ];
        return response()->json($resp,$this->responseCode);
    }

    /**
     * Reject the specified quotation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, $id)
    {
        $now = Carbon::now();
        try{
            $quotation = $this->repository->whereHas('status', function($q){
                $q->whereIn('name',['Abierta','Vencida']);
            })
            ->find($id);
            $quotationsApproved = $quotation->propoal->quotations()->whereHas('status',function($q){
                $q->where('name','Aprobada');
            })->get();

            $quotation->status_id = $this->statusRepo->findWhere([
                'type'      =>  'quotations',
                'name'      =>  'Rechazada'
            ])->first()->id;
            $quotation->comment = $request->rejected_comment;
            $quotation->rejected_date = $now->format('Y-m-d H:i:s');
            $quotation->rejected_or_authoryzed_by_user_id = Auth::user()->id;
            $quotation->save();
            $quotation->load('rejected_or_authorized_by');

            if($quotationsApproved->count()==0)
            {
                $quotation->propoal->rejected_date = $now->format('Y-m-d H:i:s');
                $quotation->propoal->status_id = $this->statusRepo->findWhere([
                    'type'      =>  'propoals',
                    'name'      =>  'Rechazada'
                ])->first()->id;
                $quotation->propoal->save();
            }

            $message = "Cotización Rechazada!";
        }catch(\Exception $e){
            DB::rollback();
            $quotation =  [];
            $message = $e->getMessage();
            $this->responseCode = 500;
        }
        $resp = [
            'data'          =>  $quotation,
            'message'       =>  $message
        ];
        return response()->json($resp,$this->responseCode);

    }


    /**
     * sync passengers to quotation specific.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function syncPassengersQuotation(Request $request, $id)
    {
        $request->validate([
            'passengers'        =>  'required|array|min:1',
            'passengers.*'      =>  'required|exists:passengers,id'
        ]);

        try{
            $quotation = $this->repository->whereHas('status',function($q){
                $q->whereIn('name',['Aprobada','Aprobada y pagada']);
            })->find($id);

            $quotation->passengers()->sync($request->passengers);
            $quotation->load('passengers','status','client');
            $message = "Actualización exitosa!";
        }catch(\Exception $e){
            $quotation =  [];
            $message = $e->getMessage();
            $this->responseCode = 500;
        }

        $resp = [
            'data'          =>  $quotation,
            'message'       =>  $message
        ];

        return response()->json($resp,$this->responseCode);
    }

    public function pdf($id)
    {
        $quotation = $this->repository->find($id);

        $params =  [
            'quotation'      =>  $quotation,
            'show_all'       => ($quotation->details->where('confirm',true)->count() == 0) ? true : false
        ];



        $pdf = PDF::loadView('reports.pdf.quotation', $params)
        ->setOption('margin-top', 16)
        ->setOption('margin-bottom', 16)
        ->setOption('margin-right', 16)
        ->setOption('margin-left', 16);
        return $pdf->inline('quotation.pdf');

    }

    public function balance(Request $request, $id)
    {
        $quotation = $this->repository
        ->with(['status','client.parent','payments'])
        ->find($id);

        $params =  [

            'quotation'      =>  $quotation,
            'view'           => 'reports.excel.quotation_balance'
        ];

        switch( $request->format )
        {
            case 'pdf':
                $pdf = PDF::loadView('reports.pdf.quotation_balance', $params)
                ->setOption('margin-top', 16)
                ->setOption('margin-bottom', 16)
                ->setOption('margin-right', 16)
                ->setOption('margin-left', 16);
                return $pdf->inline('quotation_balance.pdf');
                break;

            case 'excel':
                return Excel::download(
                    new ViewExport (
                        $params
                    ),
                    'quotation_balance.xlsx'
                );
                break;

            default:
                return response()->json($client,200);
            break;
        }
    }
}
