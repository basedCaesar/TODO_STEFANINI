<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TarefaController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*
    Cria um grupo com um name space em comum, e define as rotas padrão de uma API
*/
Route::group(['prefix'=>'v1', 'namespace'=>'App\Http\Controllers\Api\V1'], function(){


    Route::apiResource('tarefas', TarefaController::class);
});

