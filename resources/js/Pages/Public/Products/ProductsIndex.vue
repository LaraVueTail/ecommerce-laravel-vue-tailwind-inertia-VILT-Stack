<template>
  <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900">
      {{ title }}
    </h2>
    <ProductGrid :products="products.data" :cols="cols" class="pb-48"></ProductGrid>
    <PageNavigation :data="products"></PageNavigation>
  </div>
</template>

<script>
export default {
  props: ["products", "title", "cols"],
};
</script>
<script setup>
import PageNavigation from "../../../Shared/AdminDashboardComponents/PageNavigation.vue";
import ProductGrid from "../../../Shared/ProductLayouts/ProductGrid.vue";
</script>
