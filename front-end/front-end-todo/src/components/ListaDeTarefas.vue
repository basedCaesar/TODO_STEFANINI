<!--
    O template a seguir gera uma lista com todas as tarefas, 
    cria um botão para dar refresh na lista
    cria um botão que permite gerar um pdf com a lista     
    Nos permite chamar o componente Modal, quando clicamos sobre uma tarefa específica
-->
<template>
  <div class="max-w-screen-lg mx-auto p-6">

    <!-- Tabela de Tarefas -->
    <div class="overflow-auto rounded-lg border border-gray-300 dark:border-gray-700">
      <table class="min-w-full bg-slate-700 dark:bg-white">

        <!-- Cabeçalho da tabela -->
        <thead>
          <tr class="bg-slate-700 text-white dark:bg-gray-200 dark:text-black">
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Título</th>
            <th class="px-4 py-2">Status</th>
          </tr>
        </thead>

        <!-- Corpo da tabela -->
        <tbody>
          <!-- Iteração sobre as tarefas -->
          <tr
            v-for="tarefa in tarefas"
            :key="tarefa.id"
            class="bg-gray-100 cursor-pointer"
            :class="getStatusClass(tarefa.status)"
            @click="showModal(tarefa.id)"
          ><!--Quando clicado mostra o Modal da tarefa específica, e aplica a classe dependendo do status da tarefa-->
            <td class="px-4 py-2">{{ tarefa.id }}</td>
            <td class="px-4 py-2">{{ tarefa.titulo }}</td>
            <td class="px-4 py-2">{{ tarefa.status }}</td>
          </tr>
          <!-- Fim da iteração -->
        </tbody>
      </table>
    </div>

    <!-- Botões de ação -->
    <div class="flex justify-between">

      <!-- Botão para atualizar a tabela -->
      <button @click="fetchTasks" class="py-2 px-4 bg-blue-500 text-white rounded-md mt-4">Refresh Tabela</button>
      <!-- Botão para gerar o PDF -->
      <button @click="generatePDF" class="py-2 px-4 bg-green-500 text-white rounded-md mt-4">Gerar PDF</button>
    </div>



    <!-- Modal Component -->
    <Modal v-if="selectedTarefa" :tarefa="selectedTarefa" @close="selectedTarefa = null" @changesSaved="fetchTasks" @tarefaDeleted="fetchTasks" />
  </div>
</template>


<script setup>
/*
  Importa o axios para conexão com a API laravel
  Importa o componente Modal para permitir alterar ou deletar uma tarefa específica
  Importa o EventBus, que recebe um evento quando uma nova tarefa é criada e chama o método fetchTasks
  Importa pdfMake e pdfFonts para permitir a criação de um pdf apartir da tabela de tarefas
*/
import { ref } from 'vue';
import axios from 'axios';
import Modal from '@/components/Modal.vue';
import EventBus from '../utils/EventBus.js';
import pdfMake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
pdfMake.vfs = pdfFonts.pdfMake.vfs;

// Definição da lista de tarefas e tarefa selecionada
const tarefas = ref([]);
const selectedTarefa = ref(null);


// Função para buscar as tarefas da API
const fetchTasks = async () => {
  try {

    /*
      Envia requisição GET para carregar todas as tarefas
    */
    const response = await axios.get('http://localhost:8000/api/v1/tarefas');

    tarefas.value = response.data.data; //Define o valor da constante 'tarefas', como os dados dentro do campo 'data'
  } catch (error) {
    console.error('Error fetching tasks:', error); //Imprime o erro no console
  }
};

// Função para definir a classe de status da tarefa
const getStatusClass = (status) => {
  switch (status) {
    case 'não iniciado':
      return 'text-red-700 bg-red-300 hover:bg-red-400'; // Classe para o status 'não iniciado'
    case 'em andamento':
      return 'text-yellow-700 bg-yellow-300 hover:bg-yellow-400'; // Classe para o status 'em andamento'
    case 'concluído':
      return 'text-green-700 bg-green-300 hover:bg-green-400'; // Classe para o status 'concluído'
  }
};

// Função para exibir o modal com os detalhes da tarefa específica
const showModal = async (id) => {
  try {

     /*
      Envia requisição GET para carregar uma tarefa específica
    */
    const response = await axios.get(`http://localhost:8000/api/v1/tarefas/${id}`);

    selectedTarefa.value = response.data.data; //Define o valor da constante 'selectedTarefa', como os dados dentro do campo 'data'
  } catch (error) {
    console.error('Error fetching tarefa:', error);//Imprime o erro no console
  }
};

// Função para gerar o PDF com os dados das tarefas
const generatePDF = () => {
  /*
    Mapeia as informações da tabela na constante tasksData
  */
  const tasksData = tarefas.value.map((tarefa) => [tarefa.id, tarefa.titulo, tarefa.status, tarefa.descricao]); 
 
 /*
    Define a estrutura da tabela dentro do PDF
 */
  const docDefinition = {
    content: [
      { text: 'Tarefas Report', style: 'header' },
      {
        table: {
          headerRows: 1,
          widths: ['auto', 'auto', 'auto', 'auto'], // Ajustar as larguras conforme necessário
          body: [
            ['ID', 'Título', 'Status', 'Descrição'], //Define as colunas
            ...tasksData,
          ],
        },
      },
    ],
    styles: {
      header: {
        fontSize: 18,
        bold: true,
        margin: [0, 0, 0, 10],
      },
    },
  };

  pdfMake.createPdf(docDefinition).download('tarefas_report.pdf'); //Cria o PDF e inicia o download do arquivo
};

/*
  Recebe o evento 'terefaCreated' quando uma nova tarefa é criada, chamando o método fetchtasks
*/
EventBus.on('tarefaCreated', () => {
  fetchTasks();
});

fetchTasks(); //Executa a função fetchTasks para criar a tabela com todas as tarefas
</script>

