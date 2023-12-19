<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itens as ModelsItens;
use Illuminate\Support\Facades\Validator;

class Itens extends Controller
{
    public function index()
    {
        $itens = ModelsItens::all();
        return response()->json($itens);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conteudo_item' => 'required|string',
            'questaos_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->all();
        $item = ModelsItens::create($data);

        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = ModelsItens::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item não encontrado'], 404);
        }

        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'string',
            'descricao' => 'string',
            'preco' => 'numeric',
            // Adicione outras regras de validação conforme necessário
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $item = ModelsItens::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item não encontrado'], 404);
        }

        $data = $request->all();
        $item->update($data);

        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = ModelsItens::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item não encontrado'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Item excluído com sucesso']);
    }
}
