<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller {
    public function index() {
        return Estado::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100'
        ]);

        $estado = Estado::create($validated);
        return response()->json($estado, 201);
    }

    public function show($id) {
        return Estado::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $estado = Estado::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:100'
        ]);

        $estado->update($validated);
        return response()->json($estado, 200);
    }

    public function destroy($id) {
        Estado::destroy($id);
        return response()->json(null, 204);
    }
}
