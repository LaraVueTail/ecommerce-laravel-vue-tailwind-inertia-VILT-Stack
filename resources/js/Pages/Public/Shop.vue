<template>
    <!-- breadcrumb -->
    <Breadcrump :routeTree="['Shop']"></Breadcrump>
    <!-- ./breadcrumb -->

    <!-- shop wrapper -->
    <div class="container grid grid-cols-4 gap-6 pt-4 md:pb-16 items-start">
        <!-- sidebar -->
        <SideBar :categories="categories"></SideBar>
        <!-- ./sidebar -->

        <!-- products -->
        <ProductGrid :products="products" class="col-span-12 md:col-span-3" v-if="products.length>0"></ProductGrid>
        <!-- ./products -->
        <h1 v-else class="text-lg text-gray-800 font-bold">Sorry!, No products available...</h1>
    </div>
    <!-- ./shop wrapper -->
</template>
<script setup>
import Breadcrump from "../../Shared/PublicLayoutComponents/Breadcrump.vue";
import SideBar from "../../Shared/ShopComponents/SideBar.vue";
import ProductGrid from "../../Shared/Product/ProductGrid.vue";
defineProps({
    products: Array,
    categories: Array
});
</script>
