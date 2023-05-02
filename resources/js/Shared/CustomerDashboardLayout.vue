<template>
  <!-- header -->

  <Header></Header>

  <NavBar></NavBar>
  <slot></slot>
  <!-- <Notification v-if="show"></Notification> -->
</template>
<script setup>
import Header from "./CustomerDashboardLayoutComponents/Header.vue";
import NavBar from "./CustomerDashboardLayoutComponents/NavBar.vue";
import Notification from "./Notification.vue";
</script>
<script>
export default {
  data() {
    return {
      show: false,
    };
  },
  mounted() {
    this.show = true;
    setTimeout(() => (this.show = false), 2000);
  },
  watch: {
    flash: {
      deep: true,
      handler(val, oldVal) {
        this.show = true;
        setTimeout(() => (this.show = false), 2000);
      },
    },
  },
  computed: {
    flash() {
      return this.$page.props.flash;
    },
  },
};
</script>
