<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Requests\StoreTarefaRequest;
use App\models\Tarefa;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TarefaResource;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Retorna todas as tarefas do armazenamento
     */
    public function index()
    {
        return TarefaResource::collection(Tarefa::all());
    }

    /**
     * Cria uma nova tarefa no armazenamento
     */
    public function store(StoreTarefaRequest $request)
    {
        Tarefa::create($request->validated()); //Cria a tarefa nova no armazenamento, realizando a validação
        return response()->json('Tarefa Criada'); //Retorna a mensagem de exito para a requisição
    }

    /**
     * Retorna uma tarefa específica do armazenamento
     */
    public function show($id)
    {
        $tarefa = Tarefa::find($id); //Procura no armazenamento pela tarefa específica
        return new TarefaResource($tarefa); //Retorna a tarefa específica para a requisição, por meio de um resource
    }
    
   
 
    /**
     * Altera a tarefa específica no armazenamento
     */
    public function update(StoreTarefaRequest $request, Tarefa $tarefa)
    {
        $tarefa->update($request->validated()); //Realiza a alteração da tarefa
        return response()->json('Tarefa Alterada'); //Retorna a mensagem de exito para a requisição
    }

    /**
     * Remove a tarefa específica do armazenamento
     */
    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete(); //Realiza a exclusão da tarefa

        return response()->json("Tarefa apagada"); //Retorna a mensagem de exito para a requisição
    }
    
}
