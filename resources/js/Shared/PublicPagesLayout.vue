<template>
  <div class="bg-white">
    <NavBar class="z-auto" :navMenu="JSON.parse(mainMenu)"></NavBar>
    <slot></slot>
  </div>
</template>
<script>
export default {
  props: ["mainMenu"],
};
</script>

<script setup>
import NavBar from "./PublicPagesLayoutComponents/NavBar.vue";
</script>
