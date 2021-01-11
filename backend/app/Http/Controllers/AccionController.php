<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Accion;
use App\Models\Saldo;
use App\Models\Intensityfitness;
use App\Models\Corporacion;
use App\Models\Referido;
use App\Models\Solicitudretiro;
use DB;
use Auth;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AccionController extends Controller
{
    private $NAME_CONTROLLER = 'AccionController';


    
    // Obtener todos los usuarios //
    function getAll(Request $request){
        try{
        	$request->validate([
                'per_page'      =>  'nullable|integer',
                'page'          =>  'nullable|integer'
            ]);  
            if($request->id){
                $per_page = (!empty($request->per_page)) ? $request->per_page : Accion::count();
                $result = Accion::leftjoin('users','users.id','=','accions.idUsuarioFk')
                ->select('users.id as idUser','users.*','accions.*')
                ->where('idUsuarioFk',$request->id)->paginate($per_page);
            }else{
            $per_page = (!empty($request->per_page)) ? $request->per_page : Accion::count();
            $result = Accion::leftjoin('users','users.id','=','accions.idUsuarioFk');
            $result->select('users.id as idUser','users.*','accions.*');

            if($request->search!=''){
                $result->where('users.email',$request->search);
            }
            $result->where('estatus','solicitando');
            $resultado=$result->paginate($per_page);


            }
            $response = $resultado;  
  
            if($resultado->isEmpty()){
                return response()->json([
                    'msj' => 'No se encontraron registros.',
                    'data'=>[],
                    'total'=>0
                ], 200); 
            }
            return response()->json($response);
        }catch (\Exception $e) {
            Log::error('Ha ocurrido un error en '.$this->NAME_CONTROLLER.': '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de guardar los datos.',
            ], 500);
        }
    }



    
//crear 


    function create(Request $request){
        try{

            DB::beginTransaction(); // Iniciar transaccion de la base de datos

          
            $user = Accion::create([
                'referenciaPago'    => $request->referenciaPago,
                'plataforma'    => $request->plataforma,
                'idFaseFk'    => 1,
                'idUsuarioFk'     => $request->idUsuarioFk
               
         
            ]);
            DB::commit(); // Guardamos la transaccion
            return response()->json($user,201);
        }catch (\Exception $e) {
            if($e instanceof ValidationException) {
                return response()->json($e->errors(),402);
            }
            DB::rollback(); // Retrocedemos la transaccion
            Log::error('Ha ocurrido un error en '.$this->NAME_CONTROLLER.': '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de guardar los datos.',
            ], 500);
        }
    }




      // Modificar usuarios
      function update(Request $request){
        try{
    
   

            DB::beginTransaction(); 

            $arregloEnviarUpdate=array(
                'id'=>$request->id,
                'idUsuarioFk'=>$request->idUsuarioFk,
                'estatus'=>$request->estatus
            );
                $premio=self::crearAccionCambiodeFase($arregloEnviarUpdate);

            DB::commit(); 
            
            return response()->json($premio,200);

  

       }catch (\Exception $e) {
           if($e instanceof ValidationException) {
               return response()->json($e->errors(),402);
           }
           DB::rollback(); // Retrocedemos la transaccion
           Log::error('Ha ocurrido un error en '.$this->NAME_CONTROLLER.': '.$e->getMessage().', Linea: '.$e->getLine());
           return response()->json([
               'message' => 'Ha ocurrido un error al tratar de guardar los datos.',
           ], 500);
       }
   }

     // Eliminar usuarios
     function delete(Request $request){
        try{

            DB::beginTransaction(); // Iniciar transaccion de la base de datos
            $user = Accion::find($request->id);
            $user->delete();
            DB::commit(); // Guardamos la transaccion
            return response()->json("Pregunta eliminado",200);
        }catch (\Exception $e) {
            if($e instanceof ValidationException) {
                return response()->json($e->errors(),402);
            }
            DB::rollback(); // Retrocedemos la transaccion
            Log::error('Ha ocurrido un error en '.$this->NAME_CONTROLLER.': '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de guardar los datos.',
            ], 500);
        }
    }

 
}