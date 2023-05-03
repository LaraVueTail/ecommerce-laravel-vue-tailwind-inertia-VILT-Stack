<template>
  <div class="flex items-center">
    <input
      :checked="checked"
      :id="name"
      type="radio"
      @change="$emit('checked', $event.target.value)"
      :value="value"
      :name="name"
      :class="{
        'border-2 border-rose-500': error,
      }"
      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer"
    />
    <label
      :for="name"
      class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer"
      >{{ label }}</label
    >
    <div v-if="error" v-text="error" class="text-red-500 text-xs mt-1"></div>
  </div>
</template>
<script>
export default {
  props: ["label", "checked", "modelValue", "error", "name", "value"],
  emits: ["checked"],
};
</script>
