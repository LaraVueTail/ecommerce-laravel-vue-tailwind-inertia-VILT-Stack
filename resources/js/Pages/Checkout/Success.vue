<template>
    <h1>Success {{ props.customer }}</h1>
</template>
<script setup>
let props = defineProps({ customer: String })
console.log(props);
</script>