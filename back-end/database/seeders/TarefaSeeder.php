<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TarefaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numberOfTarefas = 10;
        for ($i = 0; $i < $numberOfTarefas; $i++) {
            DB::table('tarefas')->insert([
                'titulo'=>Str::random(10),
                'descricao'=>Str::random(50),
                'descricao'=>$this->getRandomStatus(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
    }

    private function getRandomStatus(){
        $status = ['não iniciado', 'em andamento', 'concluído'];
        return $status[array_rand($status)];
    }
}
