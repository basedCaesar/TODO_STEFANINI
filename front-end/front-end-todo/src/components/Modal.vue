<!--
    O template a seguir gera uma janela pop up quando determinada tarefa é clicada na lista com todas as tarefas
    Nessa janela podemos ver as informações da tarefa específica, editá-las e apagá-las
-->
<template>
    <transition name="modal">
      <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="modal-wrapper">
          <div class="modal-container bg-white rounded-lg shadow-lg overflow-hidden">
            
            <!--Header do componente-->
            <div class="modal-header  px-6 py-4  bg-slate-700 border-b border-gray-300 text-white flex justify-between items-center">
              
              <!--Título do modal-->
              <h3 class="modal-title text-lg font-semibold">Tarefa {{ tarefa.id }}</h3>
              
              <!--Botão que fecha a janela-->
              <button class="modal-close text-white hover:text-red-600 focus:outline-none" @click="close">&times;</button>
            </div>
            <!--Fim do Header-->

            <!--Apresentação dos dados da tarefa-->
            <div class="modal-body px-6 py-4 flex">
              <div class="flex-1 mr-4">
                <div class="mb-4">ID: {{ tarefa.id }}</div>
                <div class="mb-4">Título: <input v-model="editedTarefa.titulo" class="border border-black rounded px-3 py-2 w-full"></div>
                <div class="mb-4">Status: 
                  <select v-model="editedTarefa.status" class="border border-black rounded px-3 py-2 w-full">
                    <option value="não iniciado">Não Iniciado</option>
                    <option value="em andamento">Em Andamento</option>
                    <option value="concluído">Concluído</option>
                  </select>
                </div>
              </div>
              <div class="flex-1 ml-4">
                <div class="mb-4">
                  Descrição: <textarea v-model="editedTarefa.descricao" class="border border-black rounded px-3 py-2 w-full h-40 resize-none"></textarea>
                </div>
              </div>


            </div>

            <!--Botões de ação-->            
            <div class="modal-footer px-6 py-4 border-t border-gray-300 flex justify-end">
              
              <!--Botão para salvar alterações na tarefa-->
              <button @click="saveChanges" class="bg-blue-500 text-white px-4 py-2 rounded-md mr-2 hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Alterar</button>
              
              <!--Botão para deletar a tarefa-->
              <button @click="deleteTarefa" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">Deletar</button>
            </div>

          </div>
        </div>
      </div>
    </transition>
  </template>
  
  <script>

  /*
    Importa o axios para conexão com a API laravel
  */
  import axios from 'axios';
  export default {
    props: {
      tarefa: Object 
    },
    data() {
      return {
        editedTarefa: {}, // Uma cópia da terefa selecionada para a edição
        response: null
      };
    },
    mounted() {
      this.editedTarefa = { ...this.tarefa }; //Inicializa 'editedTarefa' como uma cópia da tarefa selecionada
    },
    methods: {

      //Método para fechar a janela pop up
      close() {
        this.$emit('close'); // Emite um evento para fechar o modal no componente 'ListaDeTarefas'
      },

      /*
        Método para salvar as alterações da tarefa específica no banco de dados
      */
      async saveChanges() {
      try {
        
        /*
          Envia requisição PUT para alterar a tarefa específica
        */
        const response = await axios.put(`http://localhost:8000/api/v1/tarefas/${this.editedTarefa.id}`, this.editedTarefa);
        
        this.response=response.data; //Salva a resposta da requisição

        this.$emit('changesSaved'); //Emite o evento changesSaved

        alert(this.response); //Apresenta a resposta da requisição em uma janela de alerta
        
        this.close(); //Fecha o Modal
      } catch (error) {
        console.error('Error saving changes:', error); //Imprime o erro no console
        
      }
    },

    /*
        Método para deletar a tarefa específica do banco de dados
      */
    async deleteTarefa() {
      try {
        
        /*
          Envia requisição DELETE para deletar a tarefa específica
        */
        const response = await axios.delete(`http://localhost:8000/api/v1/tarefas/${this.tarefa.id}`);
  
        this.response=response.data; //Salva a resposta da requisição
        
        this.$emit('tarefaDeleted'); //Emite o evento tarefaDeleted

        alert(this.response); //Apresenta a resposta da requisição em uma janela de alerta

        this.close();//Fecha o Modal
      } catch (error) {
        console.error('Error deleting tarefa:', error); //Imprime o erro no console
        
      }
    }
  }
};
  </script>
  
  <style scoped>
  .modal-wrapper {
    max-width: 600px;
  }
  
  .modal-close {
    font-size: 20px;
  }
  </style>
  