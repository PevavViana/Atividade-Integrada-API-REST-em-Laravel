<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoriaController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Categoria::all());
    }
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:191'],
        ]);
        $categoria = Categoria::create($validated);
        return response()->json($categoria, 201);
    }
    public function show(string $categoria): JsonResponse
    {
        $categoriaEncontrada = Categoria::find($categoria);
        if ($categoriaEncontrada === null) {
            return response()->json(['mensagem' => 'Categoria não encontrada.'], 404);
        }
        return response()->json($categoriaEncontrada);
    }
    public function update(Request $request, string $categoria): JsonResponse
    {
        $categoriaEncontrada = Categoria::find($categoria);
        if ($categoriaEncontrada === null) {
            return response()->json(['mensagem' => 'Categoria não encontrada.'], 404);
        }
        $validated = $request->validate([
            'nome' => ['sometimes', 'required', 'string', 'max:191'],
        ]);
        $categoriaEncontrada->update($validated);
        return response()->json($categoriaEncontrada);
    }
    public function destroy(string $categoria): JsonResponse|Response
    {
        $categoriaEncontrada = Categoria::find($categoria);
        if ($categoriaEncontrada === null) {
            return response()->json(['mensagem' => 'Categoria não encontrada.'], 404);
        }
        $categoriaEncontrada->delete();
        return response()->noContent();
    }
}