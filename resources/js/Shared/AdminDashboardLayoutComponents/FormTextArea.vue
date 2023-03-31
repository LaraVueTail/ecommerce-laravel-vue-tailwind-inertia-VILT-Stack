<template>
  <div>
    <label
      :for="name"
      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
      >{{ label }}</label
    >
    <textarea
      :id="name"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :rows="row"
      :class="{
        'border-2 border-rose-500': error,
      }"
      class="mb-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
      :placeholder="placeholder"
    ></textarea>
    <div v-if="error" v-text="error" class="text-red-500 text-xs mt-1"></div>
  </div>
</template>
<script>
export default {
  props: ["label", "modelValue", "error", "name", "placeholder", "row"],
  emits: ["update:modelValue"],
};
</script>
