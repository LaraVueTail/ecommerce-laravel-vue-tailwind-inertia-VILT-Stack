<template>
    <div class="container py-4 flex items-center gap-3">
        <a href="/" class="text-primary text-base">
            <i class="fa-solid fa-house"></i>
        </a>
        <span v-for="route in routeTree" :key="route" class="flex place-items-center space-x-2">
            <span class="text-sm text-gray-400">
                <i class="fa-solid fa-chevron-right"></i>
            </span>
            <p class="text-gray-600 font-medium">{{ route }}</p>
        </span>
    </div>
</template>
<script setup>
defineProps({
    routeTree: {
        type:Array,
        default: null
    }
});
</script>
