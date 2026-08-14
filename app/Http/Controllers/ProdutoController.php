<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProdutoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Produto::all());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:191'],
            'descricao' => ['nullable', 'string'],
            'media_notas' => ['nullable', 'numeric'],
            'categoria_id' => ['nullable', 'integer'],
        ]);

        $produto = Produto::create($validated);

        return response()->json($produto, 201);
    }

    public function show(string $produto): JsonResponse
    {
        $produtoEncontrado = Produto::find($produto);

        if ($produtoEncontrado === null) {
            return response()->json(['mensagem' => 'Produto não encontrado.'], 404);
        }

        return response()->json($produtoEncontrado);
    }

    public function update(Request $request, string $produto): JsonResponse
    {
        $produtoEncontrado = Produto::find($produto);

        if ($produtoEncontrado === null) {
            return response()->json(['mensagem' => 'Produto não encontrado.'], 404);
        }

        $validated = $request->validate([
            'nome' => ['sometimes', 'required', 'string', 'max:191'],
            'descricao' => ['sometimes', 'nullable', 'string'],
            'media_notas' => ['sometimes', 'nullable', 'numeric'],
            'categoria_id' => ['sometimes', 'nullable', 'integer'],
        ]);

        $produtoEncontrado->update($validated);

        return response()->json($produtoEncontrado);
    }

    public function destroy(string $produto): JsonResponse|Response
    {
        $produtoEncontrado = Produto::find($produto);

        if ($produtoEncontrado === null) {
            return response()->json(['mensagem' => 'Produto não encontrado.'], 404);
        }

        $produtoEncontrado->delete();

        return response()->noContent();
    }
}
