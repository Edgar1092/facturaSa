<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Cliente;

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

class ClientesController extends Controller
{
    private $NAME_CONTROLLER = 'ClientesController';
    
    // Obtener todos los clientes //
    function getAll(Request $request){
        try{
        	$request->validate([
                'per_page'      =>  'nullable|integer',
                'page'          =>  'nullable|integer'
            ]);  
            
            $per_page = (!empty($request->per_page)) ? $request->per_page : Cliente::count();
            $consulta = Cliente::where('estatus',0);

            if($request->search!=''){
                $consulta->where('email',$request->search);
            }

            $resultado=$consulta->paginate($per_page);

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
        $cliente = [];
        try{
            $cliente = Cliente::find($request->id);

        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($cliente,200);
    }

    //crear cliente
    function create(Request $request){
        try{

            DB::beginTransaction(); // Iniciar transaccion de la base de datos

            $cliente = Cliente::create([
                'email'    => $request->email,
                'first_name'    => $request->first_name,
                'last_name'    => $request->last_name,
                'telefono'     => $request->telefono,
                'sexo' => $request->sexo

            ]);
            DB::commit(); // Guardamos la transaccion
            return response()->json($cliente,201);
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

    // Modificar cliente
    function update(Request $request){
        try{

            DB::beginTransaction(); // Iniciar transaccion de la base de datos
            $cliente = Cliente::find($request->id);
            $cliente->email = $request->email;
            $cliente->first_name = $request->first_name;
            $cliente->last_name = $request->last_name;
            $cliente->telefono = $request->telefono;
            $cliente->sexo = $request->sexo;
            $cliente->save();
            DB::commit(); // Guardamos la transaccion
            return response()->json($cliente,200);
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


    // Eliminar cliente
    function delete(Request $request){
        try{

            DB::beginTransaction(); // Iniciar transaccion de la base de datos
            $cliente = Cliente::find($request->id);
            $cliente->delete();
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
