<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller {
    public function index() {
        return Empleado::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:250'
        ]);

        $empleado = Empleado::create($validated);
        return response()->json($empleado, 201);
    }

    public function show($id) {
        return Empleado::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $empleado = Empleado::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:250'
        ]);

        $empleado->update($validated);
        return response()->json($empleado, 200);
    }

    public function destroy($id) {
        Empleado::destroy($id);
        return response()->json(null, 204);
    }
}
