<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const page = usePage();

const showFlash = ref(false);

const flash = computed(function () {
  return page.props.flash;
});

watch(page.props.flash, function (val) {
  if (val?.flash) {
    console.log(flash.message);
    showFlash.value = true;
  }
}, {
  immediate: true,
  deep: true,
});
</script>

<template>
	<div v-if="showFlash && flash.message" @click="showFlash = false">
        {{ flash.message }} - {{ flash.type }}
    </div>
</template>