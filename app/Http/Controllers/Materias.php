<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materias as ModelsMaterias;
use Illuminate\Support\Facades\Validator;

class Materias extends Controller
{
    public function index()
    {
        $materias = ModelsMaterias::orderBy('nome_materia', 'asc')->get();
        return response()->json($materias);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome_materia' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->all();
        $materia = ModelsMaterias::create($data);

        return response()->json($materia, 201);
    }

    public function show($id)
    {
        $materia = ModelsMaterias::find($id);

        if (!$materia) {
            return response()->json(['error' => 'Matéria não encontrada'], 404);
        }

        return response()->json($materia);
    }

    public function update(Request $request, $id)
    {
        $materia = ModelsMaterias::find($id);

        if (!$materia) {
            return response()->json(['error' => 'Matéria não encontrada'], 404);
        }

        $data = $request->all();
        $materia->update($data);

        return response()->json($materia);
    }

    public function destroy($id)
    {
        $materia = ModelsMaterias::find($id);

        if (!$materia) {
            return response()->json(['error' => 'Matéria não encontrada'], 404);
        }

        $materia->delete();

        return response()->json(['message' => 'Matéria excluída com sucesso']);
    }
}
