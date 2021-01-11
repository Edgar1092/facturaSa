<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotificationOnesignalService;
use App\Repositories\NotificationRepositoryEloquent;
use DB;
use Auth;

class NotificationController extends Controller
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * @var $responseCode
     */
    protected $responseCode = 200;

    public function __construct(NotificationRepositoryEloquent $repository)
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNotificationRequest $request)
    {
        $this->responseCode = 201;
        $notification = [];

        DB::beginTransaction();
        try {
            $notification = $this->repository->create($request->all());
            $notification->users()->sync($request->users);
            $message = "Registro Exitoso";
            DB::commit();
            event(new \App\Events\NotificationCreated( $notification ));
        } catch( Exception $e ){
            DB::rollback();
            $this->responseCode = 500;
            $message = "Registro Fallido";
        }

        $resp = [
            'message'       =>  $message,
            'data'          =>  $notification
        ];

        return response()->json($resp, $this->responseCode);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = [];

        try{
            $user = $this->repository->find($id);

        }catch(\Exception $e){

            $this->responseCode = 404;
        }
        return response()->json($user,$this->responseCode);
    }

    /**
     * set viewed the specified notification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setViewed($id)
    {
        $notification = [];
        $message ="";
        try{
            $notification = $this->repository->find($id);
            $user = Auth::user();
            $notification->with([
                'users'     =>  function($q) use($user){
                    $q->where('users.id',$user->id);
                }
            ]);
            if( isset($notification->users[0]) )
            {
                $notification->users[0]->pivot->viewed = true;
                $notification->users[0]->pivot->viewed_on = date('Y-m-d H:i:s');
                $notification->users[0]->pivot->save();
            }

        }catch(\Exception $e){
            $message = $e->getMessage();
            $this->responseCode = 404;
        }


        $resp = [
            'data'      =>  $notification,
            'message'   =>  $message
        ];

        return response()->json($notification, $this->responseCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $notification = [];

        DB::beginTransaction();
        try {
            $notification = $this->repository->create($request->all());
            $notification->users()->sync($request->users);
            $message = "Registro Exitoso";
            DB::commit();
            event(new \App\Events\NotificationCreated( $notification ));
        } catch( Exception $e ){
            DB::rollback();
            $this->responseCode = 404;
            $message = "Registro Fallido";
        }

        $resp = [
            'message'       =>  $message,
            'data'          =>  $notification
        ];

        return response()->json($resp, $this->responseCode);
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
            $notification = $this->repository->find($id);
            $notification->delete();
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
