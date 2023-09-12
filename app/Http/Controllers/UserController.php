<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $response = User::create($inputs);
        return $response();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $e = User::find($id);

        $data = 'No existe el usuario';

        if (isset($e)) {
            $data = $e->first();
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
        $e = User::find($id);
        $error = true;
        $mensaje = "No existe el usuario";

        if (isset($e)) {

            $e->nombre = $request->nombre;
            $e->apellido = $request->apellido;
            $e->foto = $request->foto;

            $error = true;
            $mensaje = "No se actualizó el usuario";

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
        $e = User::find($id);

        $data = 'No existe el usuario';

        if (isset($e)) {
            $response = User::destroy($id);
            if ($response) {
                $data = $response;
            }
        }

        return $response = response()->json([
            'data' => $data
        ]);
    }
}
