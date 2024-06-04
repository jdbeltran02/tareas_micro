<?php

namespace App\Http\Controllers;

use App\Models\Prioridad;
use Illuminate\Http\Request;

class PrioridadController extends Controller {
    public function index() {
        return Prioridad::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100'
        ]);

        $prioridad = Prioridad::create($validated);
        return response()->json($prioridad, 201);
    }

    public function show($id) {
        return Prioridad::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $prioridad = Prioridad::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:100'
        ]);

        $prioridad->update($validated);
        return response()->json($prioridad, 200);
    }

    public function destroy($id) {
        Prioridad::destroy($id);
        return response()->json(null, 204);
    }
}
