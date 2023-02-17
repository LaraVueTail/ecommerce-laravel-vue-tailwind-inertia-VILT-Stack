<template>
    <!-- breadcrumb -->
    <Breadcrump :routeTree="['Shop']"></Breadcrump>
    <!-- ./breadcrumb -->

    <!-- shop wrapper -->
    <div class="container grid grid-cols-4 gap-6 pt-4 pb-16 items-start">
        <!-- sidebar -->
        <SideBar></SideBar>
        <!-- ./sidebar -->

        <!-- products -->
        <ProductGrid :products="products" class="col-span-3"></ProductGrid>
        <!-- ./products -->
    </div>
    <!-- ./shop wrapper -->
</template>
<script setup>
import Breadcrump from "../../Shared/PublicLayoutComponents/Breadcrump.vue";
import SideBar from "../../Shared/ShopComponents/SideBar.vue";
import ProductGrid from "../../Shared/Product/ProductGrid.vue";
defineProps({
    products: Array,
});
</script>
