<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AvaliacaoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('produtos', ProdutoController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('avaliacoes', AvaliacaoController::class);
