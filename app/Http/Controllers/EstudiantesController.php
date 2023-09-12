<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Estudiante::get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->input();
        $create = Estudiante::create($payload);

        return $response = response()->json([
            'data' => $create
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $e = Estudiante::find($id);

        $data = 'No existe el estudiante';

        if (isset($e)) {
            $data = $e;
        }

        return $response = response()->json([
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $e = Estudiante::find($id);
        $error = true;
        $mensaje = "No existe el estudiante";

        if (isset($e)) {

            $e->nombre = $request->nombre;
            $e->apellido = $request->apellido;
            $e->foto = $request->foto;

            $error = true;
            $mensaje = "No se actualizó el estudiante";

            if ($e->save()) {
                $error = false;
                $mensaje = $e;
            }
        }

        return response()->json([
            'error' => $error,
            'mensaje' => $mensaje
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $e = Estudiante::find($id);

        $data = 'No existe el estudiante';

        if (isset($e)) {
            $response = Estudiante::destroy($id);
            if ($response) {
                $data = $response;
            }
        }

        return $response = response()->json([
            'data' => $data
        ]);
    }
}
