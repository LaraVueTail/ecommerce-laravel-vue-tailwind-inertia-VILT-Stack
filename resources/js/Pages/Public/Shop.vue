<template>
  <ProductShopLayout :title="'Shop'">
    <ProductsIndex :products="products" :cols="3"></ProductsIndex>
  </ProductShopLayout>
</template>
<script>
export default {
  props: ["products"],
};
</script>
<script setup>
import ProductShopLayout from "../../Shared/ProductLayouts/ProductShopLayout.vue";
import ProductsIndex from "./Products/ProductsIndex.vue";
</script>
