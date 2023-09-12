<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Estudiante::all();
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $resp = Estudiante::create($inputs);
        return response()->json([
            'data'=>$resp,
            'mensaje'=>'Estudiante registrado con exito'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $exis = Estudiante::find($id);
        if (isset($exis)) {
            return response()->json([
                'data'=>$exis,
                'mensaje'=>'Estudiante encontrado con exito'
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>'No existe el estudiante.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $exis = Estudiante::find($id);
        if (isset($exis)) {
            $exis->nombre = $request->nombre;
            $exis->apellido = $request->apellido;
            $exis->foto = $request->foto;
            
            if ($exis->save()) {
                return response()->json([
                    'data'=>$exis,
                    'mensaje'=>'Estudiante actualizado con exito'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'mensaje'=>'No se actualizo el estudiante.'
                ]);
            }
            return ;
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>'No existe estudiante.'
            ]);
        }
        return isset($exis);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exis = Estudiante::find($id);
        if (isset($exis)) {
            $r = Estudiante::destroy($id);
            if ($r) {
                return response()->json([
                    'data' => $exis,
                    'mensaje' => 'Estudiante eliminado con exito.',
                ]);                    
            }else {
                return response()->json([
                    'data' => $exis,
                    'mensaje' => 'Estudiante NO existe.',
                ]);
            }
        }else {
            return response()->json([
                'error'=>true,
                'mensaje'=>'No se actualizo el estudiante.'
            ]);
        }
    }
}
