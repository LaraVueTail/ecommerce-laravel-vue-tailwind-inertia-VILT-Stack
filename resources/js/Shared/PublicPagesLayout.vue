<template>
  <div class="bg-white">
    <NavBar></NavBar>
    <slot></slot>
  </div>
</template>

<script setup>
import NavBar from "./PublicPagesLayoutComponents/NavBar.vue";
</script>
