<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Proveedor;

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

class ProveedorController extends Controller
{
    private $NAME_CONTROLLER = 'ProveedorController';

     // Obtener todos los Proveedores //
     function getAll(Request $request){
        try{
        	$request->validate([
                'per_page'      =>  'nullable|integer',
                'page'          =>  'nullable|integer'
            ]);  
            
            $per_page = (!empty($request->per_page)) ? $request->per_page : Proveedor::count();
          //  $consulta = Proveedor::where('estatus',0);

            if($request->search!=''){
                $consulta->where('email',$request->search);
                $resultado=$consulta->paginate($per_page);
            }else{
                $resultado = Proveedor::paginate($per_page);
            }

           // $resultado=$consulta->paginate($per_page);

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
                'message' => 'Ha ocurrido un error.',
            ], 500);
        }
    }

        //obtener un registro
        public function show(Request $request)
        {
            $proveedor = [];
            try{
                $proveedor = Proveedor::find($request->id);
    
            }catch(\Exception $e){
                $this->responseCode = 404;
            }
            return response()->json($proveedor,200);
        }

         //crear Proveedor
    function create(Request $request){
        try{

            DB::beginTransaction(); // Iniciar transaccion de la base de datos

            $proveedor = Proveedor::create([

                'nombre'    => $request->nombre,
                'email'    => $request->email,
                'direccion'    => $request->direccion,
                

            ]);
            DB::commit(); // Guardamos la transaccion
            return response()->json($proveedor,201);
        }catch (\Exception $e) {
            if($e instanceof ValidationException) {
                return response()->json($e->errors(),402);
            }
            DB::rollback(); // Retrocedemos la transaccion
            Log::error('Ha ocurrido un error en '.$this->NAME_CONTROLLER.': '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error.',
            ], 500);
        }
    }

    // Modificar Proveedor
    function update(Request $request){
        try{

            DB::beginTransaction(); // Iniciar transaccion de la base de datos
            $proveedor = Proveedor::find($request->id);
            $proveedor->nombre = $request->nombre;
            $proveedor->email = $request->email;
            $proveedor->direccion = $request->direccion;
            $proveedor->save();
            DB::commit(); // Guardamos la transaccion
            return response()->json($proveedor,200);
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

      // Eliminar Proveedor
      function delete(Request $request){
        try{
            DB::beginTransaction(); // Iniciar transaccion de la base de datos
            $proveedor = Proveedor::find($request->id);
            $proveedor->delete();
            DB::commit(); // Guardamos la transaccion
            return response()->json("eliminado",200);
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
