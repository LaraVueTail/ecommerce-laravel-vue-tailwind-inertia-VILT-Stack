<template>
    <!-- header -->
    <Header></Header>
    <!-- ./header -->

    <!-- navbar -->
    <NavBar></NavBar>
    <!-- ./navbar -->

    <Notification  v-if="show"></Notification>




    <slot></slot>



    <!-- footer -->
    <!-- <Footer></Footer> -->
    <!-- ./footer -->

    <!-- copyright -->
    <!-- <CopyRight></CopyRight> -->
    <!-- ./copyright -->
</template>
<script setup>
import Header from "./PublicLayoutComponents/Header.vue";
import NavBar from "./PublicLayoutComponents/NavBar.vue";
import Footer from "./PublicLayoutComponents/Footer.vue";
import CopyRight from "./PublicLayoutComponents/CopyRight.vue";
import Notification from "./Notification.vue";
</script>
<script>
export default {
  data() {
    return {
      show: false,
    }
  },
  watch: {
    flash: {
      deep: true,
      handler(val, oldVal) {
        this.show = true
        setTimeout(
            ()=>this.show=false,
            2000
        )
      },
    },
  },
  computed: {
    flash() {
      return this.$page.props.flash
    },
  },
}
</script>

