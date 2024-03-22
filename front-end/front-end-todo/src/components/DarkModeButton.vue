<!--
    O template a seguir gera um botão que alterna entre os estilos default do Tailwind 
    e os pertencentes as classes 'dark:'    
-->
<template>
  <!--Cria o botão de dark mode-->
    <button
      @click="toggleDark()"
      class="fixed top-4 right-4 py-2 px-4 bg-black text-white rounded-md border-white dark:bg-white dark:text-black border dark:border-black"
    >
      {{ isDark ? "Light" : "Dark" }} Mode <!--Nessa linha temos um teste ternário que muda o texto do botão dependendo do estado da constante isDark-->
    </button>
  </template>
  
  <script setup>
  /*
    importa useDark e useToggle para possibilitar a alteração entre os estilos
  */ 
  import { useDark, useToggle } from "@vueuse/core";
  
  const isDark = useDark(); // Variável para verificar se o modo escuro está ativado

  const toggleDark = useToggle(isDark); // Função para alternar entre os modos claro e escuro
 </script>
