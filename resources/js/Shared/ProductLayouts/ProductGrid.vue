<template>
  <div>
    <div class="mx-auto max-w-2xl px-4 py-3 sm:px-6 sm:py-5 lg:max-w-7xl lg:px-8">
      <div
        :class="`mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-${cols} xl:gap-x-8`"
      >
        <ProductGridSingle
          v-for="product in products"
          :key="product.id"
          :product="product"
        ></ProductGridSingle>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["products", "cols"],
};
</script>

<script setup>
import ProductGridSingle from "./ProductGridComponents/ProductGridSingle.vue";
</script>
