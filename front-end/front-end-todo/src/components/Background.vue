<template>
  <main class="pt-8 flex items-start justify-center bg-slate-700 dark:bg-white min-h-screen">
    <div class="min-w-[900px] flex justify-center shadow-md p-6 rounded-md bg-white dark:bg-slate-700">
      <div class="flex flex-col items-center"> 
        <div class="flex items-start sm:items-center mb-4">
          <!--
            Abaixo temos um elemento h1 fixo na página, que em conjunto com o componente CreateTarefaForm
            Cria a parte da aplicação responsável pela criação de novas tarefas
          -->
          <h1 class="text-4xl flex-1 dark:text-white">
            To-do List
          </h1>
        </div>
        <CreateTarefaForm /><!--Aqui é chamado o componente CreateTarefaVue-->

        <!--
            Abaixo temos um elemento h1 fixo na página, que em conjunto com o componente ListaDeTarefas
            Cria a parte da aplicação responsável por apresentar a lista de tarefas, gerar PDFs e chamar
            o componente Modal, que nos permite alterar e deletar tarefas
        -->
        <h1 class="pt-6 text-4xl flex-1 dark:text-white">
            Lista De Tarefas
        </h1>
        <ListaDeTarefas /><!--Aqui é chamado o componente ListaDeTarefas-->
      </div>
    </div>
  </main>
</template>

<script setup>
/*
  Importando os componentes 'CreateTarefaForm' e ListaDeTarefas de seus respectivos arquivos
  Esses componentes serão utilizados dentro do componente 'Background' para compor o layout da página
*/
import CreateTarefaForm from '../components/CreateTarefaForm.vue';
import ListaDeTarefas from '../components/ListaDeTarefas.vue';
</script>





