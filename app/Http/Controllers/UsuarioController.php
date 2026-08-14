<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsuarioController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Usuario::all());
    }
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:usuarios,email'],
            'senha' => ['required', 'string', 'max:191'],
            'cpf' => ['required', 'string', 'max:191', 'unique:usuarios,cpf'],
        ]);
        $usuario = Usuario::create($validated);
        return response()->json($usuario, 201);
    }
    public function show(string $usuario): JsonResponse
    {
        $usuarioEncontrado = Usuario::find($usuario);
        if ($usuarioEncontrado === null) {
            return response()->json(['mensagem' => 'Usuario não encontrado.'], 404);
        }
        return response()->json($usuarioEncontrado);
    }
    public function update(Request $request, string $usuario): JsonResponse
    {
        $usuarioEncontrado = Usuario::find($usuario);
        if ($usuarioEncontrado === null) {
            return response()->json(['mensagem' => 'Usuario não encontrado.'], 404);
        }
        $validated = $request->validate([
            'nome' => ['sometimes', 'required', 'string', 'max:191'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:191', 'unique:usuarios,email,' . $usuarioEncontrado->id],
            'senha' => ['sometimes', 'required', 'string', 'max:191'],
            'cpf' => ['sometimes', 'required', 'string', 'max:191', 'unique:usuarios,cpf,' . $usuarioEncontrado->id],
        ]);
        $usuarioEncontrado->update($validated);
        return response()->json($usuarioEncontrado);
    }
    public function destroy(string $usuario): JsonResponse|Response
    {
        $usuarioEncontrado = Usuario::find($usuario);
        if ($usuarioEncontrado === null) {
            return response()->json(['mensagem' => 'Usuario não encontrado.'], 404);
        }
        $usuarioEncontrado->delete();
        return response()->noContent();
    }
}
