<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PublicacionRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $publicacions = Publicacion::paginate();

        return view('publicacion.index', compact('publicacions'))
            ->with('i', ($request->input('page', 1) - 1) * $publicacions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $publicacion = new Publicacion();

        return view('publicacion.create', compact('publicacion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublicacionRequest $request): RedirectResponse
    {
        Publicacion::create($request->validated());

        return Redirect::route('publicacions.index')
            ->with('success', 'Publicacion created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $publicacion = Publicacion::find($id);

        return view('publicacion.show', compact('publicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $publicacion = Publicacion::find($id);

        return view('publicacion.edit', compact('publicacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublicacionRequest $request, Publicacion $publicacion): RedirectResponse
    {
        $publicacion->update($request->validated());

        return Redirect::route('publicacions.index')
            ->with('success', 'Publicacion updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Publicacion::find($id)->delete();

        return Redirect::route('publicacions.index')
            ->with('success', 'Publicacion deleted successfully');
    }
}
