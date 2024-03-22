<!--
    O template a seguir gera um formulário para a criação de novas tarefas 
    Recebendo o título obrigatóriamente e a descrição da tarefa de forma opcional
-->
<template>
  <div class=" p-6 rounded-md bg-slate-700 dark:bg-white">

     <!-- Título do formulário -->
    <h2 class="text-2xl font-semibold mb-4 text-white dark:text-black">Crie Uma Nova Tarefa</h2>

    <!-- Formulário -->
    <form @submit.prevent="submitForm">

      <!-- Campo de entrada para o título -->
      <div class="mb-4">
        <label for="titulo" class="block mb-2 text-white dark:text-black">Título:</label>
        <input type="text" id="titulo" v-model="formData.titulo" required class="w-full px-3 py-2 border rounded-md text-white focus:outline-none focus:border-blue-500 bg-slate-800 dark:bg-gray-200 dark:border-black dark:text-black">
      </div>

      <!-- Campo de entrada para a descrição -->
      <div class="mb-4">
        <label for="descricao" class="block mb-2 text-white dark:text-black">Descrição:</label>
        <textarea id="descricao" v-model="formData.descricao" class="w-full px-3 py-2 border rounded-md text-white h-28 focus:outline-none focus:border-blue-500 bg-slate-800 dark:bg-gray-200 dark:border-black dark:text-black resize-none"></textarea>
      </div>

      <!-- Botão para criar a tarefa -->
      <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Criar</button>
    </form>

  </div>
</template>

<script>
/*
  Importa o axios para fazer ligação com a API laravel, para poder criar a nova tarefa
  
  Importa o EventBus para enviar um evento para o componente ListaDeTarefas, 
  esse evento é chamado quando uma nova tarefa é criada, automaticamente chamando a função fetchTasks,
  que gera a lista de todas as tarefas novamente.
*/
import axios from 'axios';
import EventBus from '../utils/EventBus.js';

export default {
  data() {
    return {
      // Dados do formulário
      formData: {
        titulo: '', // Título da tarefa
        descricao: '' // Descrição da tarefa
      },
      response: null // Resposta da requisição
    };
  },
  methods: {

    // Método para enviar o formulário
    async submitForm() {
      try {

        /*
          Envia requisição POST para criar a tarefa
        */
        const response = await axios.post('http://localhost:8000/api/v1/tarefas', this.formData);

        this.response = response.data; // Armazenar a resposta da requisição

        EventBus.emit('tarefaCreated'); // Emitir evento para indicar que uma tarefa foi criada

        /*
          Limpar os campos do formulário após a criação da tarefa
        */
        this.formData.titulo='';
        this.formData.descricao='';

        alert(this.response); // Exibir a resposta da requisição em um alerta

      } catch (error) {

        console.error('Error submitting form:', error); //Apresenta o erro no console
        
        this.response = null; // Limpar a resposta em caso de erro
      }
    }

    
  }
};
</script>
