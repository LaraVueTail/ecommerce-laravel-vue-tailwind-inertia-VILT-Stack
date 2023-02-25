<template>
        <div class="md:pb-16">
        <h2 class="text-md text-center md:text-left md:text-2xl font-medium text-gray-800 md:mb-6">
            <slot></slot>
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-6">
            <Product v-for="product in products" :key="product.id" :product="product"></Product>
        </div>
    </div>
</template>
<script setup>
import Product from './Product.vue'
defineProps({
    products:Array
})
</script>