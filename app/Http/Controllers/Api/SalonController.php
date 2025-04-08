<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salon;

class SalonController extends Controller
{
    public function index(Request $request)
    {
        $salons = Salon::paginate();

        // Devuelve los datos en formato JSON
        return response()->json($salons);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:salons',
            'direccion' => 'required',
            'precio' => 'required|numeric',
            'capacidad' => 'nullable|integer',
        ]);

        $salon = Salon::create($request->all());

        return response()->json($salon, 201);
    }

    public function show($id)
    {
        $salon = Salon::findOrFail($id);
        return response()->json($salon);
    }

    public function update(Request $request, $id)
    {
        $salon = Salon::findOrFail($id);

        $request->validate([
            'nombre' => 'required|unique:salons,nombre,' . $id,
            'direccion' => 'required',
            'precio' => 'required|numeric',
            'capacidad' => 'nullable|integer',
        ]);

        $salon->update($request->all());

        return response()->json($salon);
    }

    public function destroy($id)
    {
        $salon = Salon::findOrFail($id);
        $salon->delete();

        return response()->json(null, 204);
    }
}
