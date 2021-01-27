<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use App\Models\Inventario;
use App\Models\Producto;

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

class InventarioController extends Controller
{
    private $NAME_CONTROLLER = 'InventarioController';

  

    // OBTENER TODO EL INVENTARIO
    function getAll(Request $request){
        try{
        	$request->validate([
                'per_page'      =>  'nullable|integer',
                'page'          =>  'nullable|integer'
            ]);  
            
            $per_page = (!empty($request->per_page)) ? $request->per_page : Inventario::count();
        

            $inventarios = Inventario::leftJoin('productos', 'inventarios.producto_id', '=', 'productos.id')
            ->select(DB::raw('SUM(inventarios.entrada) AS entrada'),DB::raw('SUM(inventarios.salida) AS salida'),'productos.nombre','productos.id') 
            ->groupBy('productos.id')
            ->paginate($per_page);
         
            $response = $inventarios;  
  
            if($inventarios->isEmpty()){
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
        $inventario = [];
        try{
            $inventario = Inventario::find($request->id);

        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($inventario,200);
    }


    // FUNCIIOON CREAR
    function create(Request $request){
        try{

            DB::beginTransaction(); // Iniciar transaccion de la base de datos
            if($request->tipo=="entrada"){
                $inventario = Inventario::create([
                    'salida' => 0,
                    'entrada' => $request ->monto,
                    'producto_id' =>$request ->producto_id
                ]);
            }else{
                $inventario = Inventario::create([
                    'entrada' => 0,
                    'salida' => $request ->monto,
                    'producto_id' =>$request ->producto_id
                ]);
            }
            DB::commit(); // Guardamos la transaccion
            return response()->json($inventario,201);
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

     // FUNCION MODIFICAR
     function update(Request $request){
        try{

            DB::beginTransaction(); // Iniciar transaccion de la base de datos
            $inventadio = Inventario::find($request->id);
            $inventadio->producto_id = $request->producto_id;
            $inventadio->entrada = $request->entrada;
            $inventadio->salida = $request->salida;
            $inventadio->monto = $request->monto;
            $inventadio->save();
            DB::commit(); // Guardamos la transaccion
            return response()->json($inventario,200);
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


    // FUNCION ELIMINAR
    function delete(Request $request){
        try{
            DB::beginTransaction(); // Iniciar transaccion de la base de datos
            $inventario = Inventario::find($request->id);
            $inventario->delete();
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

    function crear(Request $request){
    try{
        DB::beginTransaction();
        if($request->tipo=="entrada"){
            $inventario = Inventario::create([
                
                'entrada' => $request ->monto,
                'id_producto' =>$request ->id_producto
            ]);
        }else{
            $inventario = Inventario::create([
                
                'salida' => $request ->monto,
                'id_producto' =>$request ->id_producto
            ]);
        }
    DB::commit(); // Guardamos la transaccion
    return response()->json($inventario,201);
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
