<template>
    <!-- header -->
    <Header></Header>
    <!-- ./header -->

    <!-- navbar -->
    <NavBar></NavBar>
    <!-- ./navbar -->

    <!-- sidebar -->
    <!-- <Sidebar class="hidden"></Sidebar> -->
    <!-- ./sidebar -->

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
import Header from "./CustomerDashboardLayoutComponents/Header.vue";
import Sidebar from "./CustomerDashboardLayoutComponents/Sidebar.vue";
import NavBar from "./CustomerDashboardLayoutComponents/NavBar.vue";
import Notification from "./Notification.vue";

// import Footer from "./CustomerLayoutComponents/Footer.vue";
// import CopyRight from "./CustomerLayoutComponents/CopyRight.vue";
</script>
<script>
export default {
  data() {
    return {
      show: false,
    }
  },
  mounted(){
    this.show = true
        setTimeout(
            ()=>this.show=false,
            2000
        )
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

