<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publicacion;

class PublicacionController extends Controller
{
    public function index()
    {
        return response()->json(Publicacion::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'fechaP' => 'required|date',
            'contacto' => 'required|string',
            'nombre' => 'required|string|in:Lugar A,Lugar B,Lugar C,Lugar D',
        ]);

        $publicacion = Publicacion::create($request->all());

        return response()->json($publicacion, 201);
    }

    public function show($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        return response()->json($publicacion);
    }

    public function update(Request $request, $id)
    {
        $publicacion = Publicacion::findOrFail($id);

        $request->validate([
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'fechaP' => 'required|date',
            'contacto' => 'required|string',
            'nombre' => 'required|string|in:Lugar A,Lugar B,Lugar C,Lugar D',
        ]);

        $publicacion->update($request->all());

        return response()->json($publicacion);
    }

    public function destroy($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        $publicacion->delete();

        return response()->json(null, 204);
    }
}
