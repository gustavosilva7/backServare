<?php

namespace App\Http\Controllers;

use App\Models\Usuarios as ModelsUsuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Usuarios extends Controller
{
    public function index()
    {
        $usuarios = ModelsUsuarios::orderBy('nome_usuario', 'asc')->get();
        return response()->json($usuarios);
    }

    public function store(Request $request)
    {

        $token = Str::random(45);

        $data = $request->all();
        $data['token_usuario'] = $token;

        $usuario = ModelsUsuarios::create($data);

        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        $usuario = ModelsUsuarios::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuário com o ID ' . $id . ' não encontrado'], 404);
        }

        return response()->json($usuario);
    }

    public function update(Request $request, $id)
    {

        $usuario = ModelsUsuarios::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuário com o ID ' . $id . ' não encontrado'], 404);
        }

        $data = $request->all();

        // Verifique se a senha foi fornecida e faça o hash dela
        if (isset($data['senha_usuario'])) {
            $data['senha_usuario'] = Hash::make($data['senha_usuario']);
        }

        $usuario->update($data);

        return response()->json($usuario);
    }

    public function destroy($id)
    {
        $usuario = ModelsUsuarios::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuário com o ID ' . $id . ' não encontrado'], 404);
        }

        $usuario->delete();

        return response()->json(['message' => 'Usuário excluído com sucesso']);
    }
}
