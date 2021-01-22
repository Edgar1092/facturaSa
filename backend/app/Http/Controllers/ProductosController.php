<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
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

class ProductosController extends Controller
{

    private $NAME_CONTROLLER = 'ProductosController';
    
    // Obtener todos los productos //
    function getAll(Request $request){
        try{
        	$request->validate([
                'per_page'      =>  'nullable|integer',
                'page'          =>  'nullable|integer'
            ]);  
            
            $per_page = (!empty($request->per_page)) ? $request->per_page : Producto::count();
           // $consulta = Producto::where('estatus',0);

            if($request->search!=''){
                $consulta->where('codigo',$request->search);
                $resultado= $consulta ->paginate($per_page);
            }else{
                $resultado= Producto::paginate($per_page);
            }

          //  $resultado=$consulta->paginate($per_page);

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
        $producto = [];
        try{
            $produto = Producto::find($request->id);

        }catch(\Exception $e){
            $this->responseCode = 404;
        }
        return response()->json($producto,200);
    }

    //crear producto
    function create(Request $request){
        try{

            DB::beginTransaction(); // Iniciar transaccion de la base de datos

            $producto = Producto::create([
                'codigo'    => $request->codigo,
                'codigo_proveedor'    => $request->codigo_proveedor,
                'nombre'    => $request->nombre,
                'costo'     => $request->costo,
                'precio1'     => $request->precio1,
                'precio2'     => $request->precio2,
                'precio3'     => $request->precio3,
                'departamento'     => $request->departamento,
                

            ]);
            DB::commit(); // Guardamos la transaccion
            return response()->json($producto,201);
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
            $producto = Producto::find($request->id);
            $producto->codigo = $request->codigo;
            $producto->codigo_proveedor = $request->codigo_proveedor;
            $producto->nombre = $request->nombre;
            $producto->costo = $request->costo;
            $producto->precio1 = $request->precio1;
            $producto->precio2 = $request->precio2;
            $producto->precio3 = $request->precio3;
            $producto->departamento = $request->departamento;
            $producto->save();
            DB::commit(); // Guardamos la transaccion
            return response()->json($producto,200);
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


    // Eliminar producto
    function delete(Request $request){
        try{

            DB::beginTransaction(); // Iniciar transaccion de la base de datos
            $producto = Producto::find($request->id);
            $producto->delete();
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

        // obtener productos
        function productosTodos(Request $request){
            try{
    
                DB::beginTransaction(); // Iniciar transaccion de la base de datos
                $productos = Producto::get();
                DB::commit(); // Guardamos la transaccion
                return response()->json($productos,200);
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
