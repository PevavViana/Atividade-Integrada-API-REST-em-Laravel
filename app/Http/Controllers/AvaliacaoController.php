<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AvaliacaoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Avaliacao::all());
    }
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'titulo' => ['required', 'string', 'max:191'],
            'descricao' => ['nullable', 'string'],
            'nota' => ['required', 'numeric'],
            'data' => ['required', 'date'],
            'usuario_id' => ['nullable', 'integer'],
            'produto_id' => ['nullable', 'integer'],
        ]);
        $avaliacao = Avaliacao::create($validated);
        return response()->json($avaliacao, 201);
    }
    public function show(string $avaliacao): JsonResponse
    {
        $avaliacaoEncontrada = Avaliacao::find($avaliacao);
        if ($avaliacaoEncontrada === null) {
            return response()->json(['mensagem' => 'Avaliacao não encontrada.'], 404);
        }
        return response()->json($avaliacaoEncontrada);
    }
    public function update(Request $request, string $avaliacao): JsonResponse
    {
        $avaliacaoEncontrada = Avaliacao::find($avaliacao);
        if ($avaliacaoEncontrada === null) {
            return response()->json(['mensagem' => 'Avaliacao não encontrada.'], 404);
        }
        $validated = $request->validate([
            'titulo' => ['sometimes', 'required', 'string', 'max:191'],
            'descricao' => ['sometimes', 'nullable', 'string'],
            'nota' => ['sometimes', 'required', 'numeric'],
            'data' => ['sometimes', 'required', 'date'],
            'usuario_id' => ['sometimes', 'nullable', 'integer'],
            'produto_id' => ['sometimes', 'nullable', 'integer'],
        ]);
        $avaliacaoEncontrada->update($validated);
        return response()->json($avaliacaoEncontrada);
    }
    public function destroy(string $avaliacao): JsonResponse|Response
    {
        $avaliacaoEncontrada = Avaliacao::find($avaliacao);
        if ($avaliacaoEncontrada === null) {
            return response()->json(['mensagem' => 'Avaliacao não encontrada.'], 404);
        }
        $avaliacaoEncontrada->delete();
        return response()->noContent();
    }
}