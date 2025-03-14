<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Centro;

class CentroController extends Controller
{
    public function index()
    {
        $centros = Centro::all();
        return view('centros.index', compact('centros'));
    }

    public function create()
    {
        return view('centros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'horario' => 'required|string|max:255',
        ]);

        Centro::create($request->all() + ['foto' => 'foto.jpg']);

        return redirect()->route('centros.index')->with('success', 'Centro creado exitosamente.');
    }

    public function edit(Centro $centro)
    {
        return view('centros.edit', compact('centro'));
    }

    public function update(Request $request, Centro $centro)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'horario' => 'required|string|max:255',
        ]);

        $centro->update($request->all());

        return redirect()->route('centros.index')->with('success', 'Centro actualizado correctamente.');
    }

    public function destroy(Centro $centro)
    {
        $centro->delete();
        return redirect()->route('centros.index')->with('success', 'Centro eliminado correctamente.');
    }
}
