<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TarefaResource extends JsonResource
{
    /**
     * Cria um array com os campos necessários para as requests
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'titulo'=>$this->titulo,
            'descricao'=>$this->descricao,
            'status'=>$this->status
        ];
    }
}
