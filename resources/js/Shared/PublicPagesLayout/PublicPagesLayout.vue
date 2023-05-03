<template>
  <div class="bg-gray-50">
    <NavBar :navMenu="JSON.parse($page.props.mainMenu)" @cartOpen="cartClick()"></NavBar>
    <slot></slot>
    <CartNew
      :cartShow="cart"
      :key="cartToggle"
      :cartContent="$page.props.cartContent"
    ></CartNew>
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
import NavBar from "../PublicPagesLayout/PublicPagesLayoutComponents/NavBar.vue";
import Footer from "../PublicPagesLayout/PublicPagesLayoutComponents/Footer.vue";
import CartNew from "../../Pages/Cart/Cart.vue";
</script>
