<template>
  <NavBar></NavBar>
  <SideBar></SideBar>
  <Notification v-if="show"></Notification>

  <div class="p-4 sm:ml-64">
    <div class="my-10">
      <slot></slot>
    </div>
  </div>
</template>
<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import NavBar from "./AdminDashboardLayoutComponents/NavBar.vue";
import SideBar from "./AdminDashboardLayoutComponents/SideBar.vue";
import Notification from "../Notification.vue";

// initialize components based on data attribute selectors
onMounted(() => {
  initFlowbite();
});
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
