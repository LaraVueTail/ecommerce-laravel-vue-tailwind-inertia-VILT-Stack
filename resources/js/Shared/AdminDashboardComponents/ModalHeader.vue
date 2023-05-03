<template>
  <div
    class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600"
  >
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
      {{ heading }}
    </h5>

    <RefreshPage :url="url"></RefreshPage>
  </div>
</template>
<script>
export default {
  props: ["heading", "url"],
};
</script>
<script setup>
import RefreshPage from "./RefreshPage.vue";
</script>
