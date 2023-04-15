<template>
  <div class="bg-gray-50">
    <NavBar :navMenu="JSON.parse(mainMenu)" @cartOpen="cartClick()"></NavBar>
    <slot></slot>
    <CartNewVue :cartShow="cart" :key="cartToggle"></CartNewVue>
    <Footer></Footer>
  </div>
</template>
<script>
export default {
  props: ["mainMenu"],
  data() {
    return {
      cart: false,
      cartToggle: true,
    };
  },
  methods: {
    cartClick() {
      this.cart = true;
      this.cartToggle = !this.cartToggle;
    },
  },
};
</script>

<script setup>
import NavBar from "./PublicPagesLayoutComponents/NavBar.vue";
import Footer from "./PublicPagesLayoutComponents/Footer.vue";
import CartNewVue from "../Pages/Cart/CartNew.vue";
</script>
