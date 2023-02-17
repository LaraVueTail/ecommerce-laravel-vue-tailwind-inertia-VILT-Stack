<template>
          <!-- wishlist -->
          <div class="container md:px-64 space-y-4 mt-10">
            <h3 class="text-2xl font-medium text-gray-700">Cart({{ props.cartCount }})</h3>
            <cart-item v-for="item in props.cartContent" :key="item" :cartItem="item"></cart-item>
            <h3 class="text-xl text-gray-700 text-right">Total : {{ cartTotal }}</h3>
        </div>

        <!-- ./wishlist -->
</template>
<script setup>
import CartItem from '../../Shared/CartComponents/CartItem.vue';
let props = defineProps({
    cartContent:Object,
    cartCount:Number,
    cartTotal:Number,
})
console.log(props.cartContent);
</script>