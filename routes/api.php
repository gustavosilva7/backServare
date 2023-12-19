<?php

use App\Http\Controllers\Questoes;
use App\Http\Controllers\Usuarios;
use App\Http\Controllers\Provas;
use App\Http\Controllers\Materias;
use App\Http\Controllers\Itens;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/usuarios', [Usuarios::class, 'index']);
Route::post('/usuarios', [Usuarios::class, 'store']);
Route::get('/usuarios/{id}', [Usuarios::class, 'show']);
Route::put('/usuarios/{id}', [Usuarios::class, 'update']);
Route::delete('/usuarios/{id}', [Usuarios::class, 'destroy']);

Route::get('usuarios/{userId}/questoes', [Questoes::class, 'index']);
Route::post('usuarios/{userId}/questoes', [Questoes::class, 'store']);
Route::get('questoes/{id}', [Questoes::class, 'show']);
Route::put('questoes/{id}', [Questoes::class, 'update']);
Route::delete('questoes/{id}', [Questoes::class, 'destroy']);

Route::get('{userId}/materias', [Materias::class, 'index']);
Route::post('{userId}/materias', [Materias::class, 'store']);
Route::get('{userId}/materias/{id}', [Materias::class, 'show']);
Route::put('{userId}/materias/{id}', [Materias::class, 'update']);
Route::delete('{userId}/materias/{id}', [Materias::class, 'delete']);

Route::get('{userId}/itens', [Itens::class, 'index']);
Route::post('{userId}/itens', [Itens::class, 'store']);
Route::get('{userId}/itens/{id}', [Itens::class, 'show']);
Route::put('{userId}/itens/{id}', [Itens::class, 'update']);
Route::delete('{userId}/itens/{id}', [Itens::class, 'delete']);

Route::get('{userId}/provas', [Provas::class, 'index']);
Route::post('{userId}/provas', [Provas::class, 'store']);
Route::get('{userId}/provas/{id}', [Provas::class, 'show']);
Route::put('{userId}/provas/{id}', [Provas::class, 'update']);
Route::delete('{userId}/provas/{id}', [Provas::class, 'delete']);
