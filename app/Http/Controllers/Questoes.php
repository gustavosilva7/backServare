<?php

namespace App\Http\Controllers;

use App\Models\Questaos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


use App\Models\Itens;
use App\Models\Respostas;

class Questoes extends Controller
{
    public function index($id_materia)
    {
        $questoes = Questaos::where('materia_questao', $id_materia)->orderBy('created_at', 'asc')->get();
        return response()->json($questoes);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('imagem')) {
            $image = $request->file('imagem');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('uploads/questoes', $imageName);

            $data['image'] = $imageName;

            Questaos::create($data);

            return response()->json(['message' => 'Upload realizado com sucesso!', 'image_path' => $imageName], 201);
        }
    }


    public function show($id)
    {
        $questao = Questaos::find($id);

        if (!$questao) {
            return response()->json(['error' => 'Questão não encontrada'], 404);
        }

        return response()->json($questao);
    }

    public function update(Request $request, $id)
    {
        $questao = Questaos::find($id);

        if (!$questao) {
            return response()->json(['error' => 'Questão não encontrada'], 404);
        }

        $data = $request->all();
        $questao->update($data);

        return response()->json($questao);
    }

    public function destroy($id)
    {
        $questao = Questaos::find($id);

        if (!$questao) {
            return response()->json(['error' => 'Questão não encontrada'], 404);
        }

        $questao->delete();

        return response()->json(['message' => 'Questão excluída com sucesso']);
    }

    public function getImage($filename)
    {
        $path = storage_path('app/public/uploads/users/' . $filename);

        if (File::exists($path)) {
            $file = File::get($path);
            $type = File::mimeType($path);

            return response($file, 200)->header('Content-Type', $type);
        }

        return response()->json(["message" => "Imagem não encontrada"], 404);
    }
}