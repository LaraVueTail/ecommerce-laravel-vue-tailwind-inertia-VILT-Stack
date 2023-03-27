<template>
  <section
    class="dark:bg-gray-900 w-full h-screen overflow-x-hidden md:overflow-x-visible p-1"
  >
    <div class="mx-auto max-w-screen-xl px-1 lg:px-12">
      <!-- Start coding here -->
      <h1 class="text-2xl text-gray-800 mb-6 font-poppins p-3 sm:p-5">Orders</h1>

      <AlertDanger v-if="deleteAlert" :orderId="deleteOrderId"></AlertDanger>

      <Link href="/admin-dashboard/orders/create">
        <button
          type="button"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
        >
          + Add Order
        </button>
      </Link>

      <div
        class="bg-white dark:bg-gray-800 relative shadow-md rounded-lg border-2 border-gray-200"
      >
        <Filters :filters="filters"></Filters>

        <OrdersTable :orders="orders" @deleteOrder="deleteOrder"></OrdersTable>

        <PageNavigation :orders="orders"></PageNavigation>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["orders", "filters"],
  data() {
    return {
      deleteAlert: false,
      deleteOrderId: null,
    };
  },
  methods: {
    deleteOrder(id) {
      console.log(id);
      this.deleteAlert = true;
      setTimeout(() => (this.deleteAlert = false), 2000);
      this.deleteOrderId = id;
    },
  },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import Filters from "../../../Shared/Filters/Filters.vue";
import OrdersTable from "../../../Shared/AdminDashboardLayoutComponents/OrdersTable.vue";
import PageNavigation from "../../../Shared/AdminDashboardLayoutComponents/PageNavigation.vue";
import AlertDanger from "../../../Shared/AdminDashboardLayoutComponents/AlertDanger.vue";
onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
