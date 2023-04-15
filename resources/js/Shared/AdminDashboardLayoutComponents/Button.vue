<template>
  <button
    type="submit"
    :class="{
      'bg-blue-700 hover:bg-blue-800 focus:ring-blue-300  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800':
        color === 'blue',
      'bg-red-700 hover:bg-red-800 focus:ring-red-300  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800':
        color === 'red',
      'bg-green-700 hover:bg-green-800 focus:ring-green-300  dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800':
        color === 'green',
    }"
    class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center"
  >
    {{ text }}
  </button>
</template>
<script>
export default {
  props: ["text", "color"],
};
</script>
