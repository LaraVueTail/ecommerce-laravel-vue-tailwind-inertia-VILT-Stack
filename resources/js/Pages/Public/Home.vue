<template>
    <!-- banner -->
    <HeroBanner></HeroBanner>
    <!-- ./banner -->

    <!-- categories -->
    <CategoriesList></CategoriesList>
    <!-- ./categories -->

    <!-- new arrival -->
    <ProductGrid :products="products" class="container"
        >Top New Arrivals</ProductGrid
    >
    <!-- ./new arrival -->

    <!-- ads -->
    <AdsBanner></AdsBanner>
    <!-- ./ads -->

    <!-- recommended product -->
    <ProductGrid :products="products" class="container"
        >Best Sellers</ProductGrid
    >
    <!-- ./recommended product -->
</template>
<script setup>
import HeroBanner from "../../Shared/HeroBanner.vue";
import AdsBanner from "../../Shared/AdsBanner.vue";
import CategoriesList from "../../Shared/CategoriesList.vue";
import ProductGrid from "../../Shared/Product/ProductGrid.vue";


defineProps({
    products: Array
});
</script>
<!-- <script>
import PublicLayout from '../../Shared/PublicLayout.vue'

export default {
    layout: PublicLayout
}
</script> -->