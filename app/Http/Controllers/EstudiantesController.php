<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    public function index()
    {
       return Estudiante::all();
    }

    public function store(Request $request)
    {
        $inputs = $request->input();
        $e = Estudiante::create($inputs);
        return response()->json([
            'error' => $e,
            'mensaje' => "Estudiante guardado",
       ]);;
    }

    public function update(Request $request, $id)
    {
        $e = Estudiante::find($id);
        if(isset($e)){
            $e->nombre = $request -> nombre;
            $e->apellido = $request -> apellido;
            $e->foto = $request -> foto;
            if ($e->save()){
                return response()->json([
                    'data' => $e,
                    'mensaje' => "Estudiante actualizado",
               ]);
            }else{
                return response()->json([
                    'error' => true,
                    'mensaje' => "No se actualizo el estudiante",
               ]);
            }
        }else{
            return response()->json([
                 'error' => true,
                 'mensaje' => "No existe el estudiante",
            ]);
        }
    }

    public function show($id)
    {
        $e = Estudiante::find($id);
        if(isset($e)){
            return response()->json([
                'data' => $e,
                'mensaje' => "Estudiante encontrado",
            ]);
        }else{
            return response()->json([
                'error' => true,
                'mensaje' => "No existe el estudiante",
           ]);
        }
    }

    public function destroy($id)
    {
        $e = Estudiante::find($id);
        if(isset($e)){
            $res=Estudiante::destroy($id);
            if($res){
                return response()->json([
                    'data' => $e,
                    'mensaje' => "Estudiante eliminado",
                ]);
            }else{
                return response()->json([
                    'data' => $e,
                    'mensaje' => "No existe el estudiante",
               ]);
            }

        }else{
            return response()->json([
                'error' => true,
                'mensaje' => "No existe el estudiante",
           ]);
        }
    }
}
