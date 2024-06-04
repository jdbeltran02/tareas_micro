<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller {
    public function index() {
        return Tarea::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'titulo' => 'required|string|max:120',
            'descripcion' => 'required|string',
            'fechaEstimadaFinalizacion' => 'required|date',
            'creadorTarea' => 'required|string|max:250',
            'idEmpleado' => 'required|exists:empleados,id',
            'idEstado' => 'required|exists:estados,id',
            'idPrioridad' => 'required|exists:prioridades,id'
        ]);

        $tarea = Tarea::create($validated);
        return response()->json($tarea, 201);
    }

    public function show($id) {
        return Tarea::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $tarea = Tarea::findOrFail($id);
        $validated = $request->validate([
            'titulo' => 'sometimes|required|string|max:120',
            'descripcion' => 'sometimes|required|string',
            'fechaEstimadaFinalizacion' => 'sometimes|required|date',
            'fechaFinalizacion' => 'sometimes|date|nullable',
            'creadorTarea' => 'sometimes|required|string|max:250',
            'observaciones' => 'sometimes|string|nullable',
            'idEmpleado' => 'sometimes|required|exists:empleados,id',
            'idEstado' => 'sometimes|required|exists:estados,id',
            'idPrioridad' => 'sometimes|required|exists:prioridades,id'
        ]);

        $tarea->update($validated);
        return response()->json($tarea, 200);
    }

    public function destroy($id) {
        Tarea::destroy($id);
        return response()->json(null, 204);
    }
}

