<template>
  <section
    class="dark:bg-gray-900 w-full h-screen overflow-x-hidden md:overflow-x-visible p-1"
  >
    <div class="mx-auto max-w-screen-xl px-1 lg:px-12">
      <!-- Start coding here -->
      <h1 class="text-2xl text-gray-800 mb-2 font-poppins py-3 sm:py-2 font-medium">
        Orders
      </h1>

      <AlertDelete
        v-if="deleteAlertOrder"
        @close="deleteAlertOrder = false"
        @confirm="deleteOrderConfirm()"
        :text="deleteAlertOrderText"
      ></AlertDelete>

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
        <Filters
          :filters="filters"
          :searchPlaceHolder="'Search by Order ID, User Name/Email..'"
          :currentPage="orders.current_page"
          :dataName="'orders'"
          :sortByFilters="{ dateSort: true, priceSort: true }"
          :enableFilters="{
            search: true,
            dateRange: true,
            sortBy: true,
            filterBy: { orderStatus: true },
          }"
        ></Filters>

        <TableOrders :orders="orders" @deleteOrder="deleteOrder"></TableOrders>

        <PageNavigation :data="orders"></PageNavigation>
      </div>
    </div>
  </section>
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
  props: ["orders", "filters"],
  data() {
    return {
      deleteAlertOrder: false,
      deleteAlertOrderText: "",
      orderId: null,
    };
  },
  methods: {
    deleteOrder(orderId) {
      window.scrollTo(0, 0);
      this.deleteAlertOrder = true;
      this.orderId = orderId;
      this.deleteAlertOrderText = `Deleting the order will permanently removed from the database. You can't recover the
      order again. Are you sure about deleting?`;
      setTimeout(() => (this.deleteAlertOrder = false), 5000);
    },
    deleteOrderConfirm() {
      router.delete(`/admin-dashboard/orders/${this.orderId}`, {
        preserveState: false,
      });
    },
  },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import Filters from "../../../Shared/Filters/Filters.vue";
import TableOrders from "../../../Shared/Tables/TableOrders.vue";
import PageNavigation from "../../../Shared/AdminDashboardComponents/PageNavigation.vue";
import AlertDelete from "../../../Shared/AdminDashboardComponents/AlertDelete.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
