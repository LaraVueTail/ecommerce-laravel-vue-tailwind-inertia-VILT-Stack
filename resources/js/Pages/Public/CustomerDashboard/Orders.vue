<template>
  <CustomerDashboardLayoutVue>
    <section
      class="dark:bg-gray-900 w-full h-full overflow-x-hidden md:overflow-x-visible p-1"
    >
      <div class="mx-auto max-w-screen-xl">
        <!-- Start coding here -->
        <h1 class="text-xl text-gray-800 mb-2 font-poppins py-3 sm:py-2 font-medium">
          Orders
        </h1>

        <div
          class="bg-white dark:bg-gray-800 relative shadow-md rounded-lg border-2 border-gray-200"
        >
          <Filters
            :filters="filters"
            :searchPlaceHolder="'Search by Order ID'"
            :sendToUrl="'/dashboard'"
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
  </CustomerDashboardLayoutVue>
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
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import Filters from "../../../Shared/Filters/Filters.vue";
import TableOrders from "../../../Shared/AdminDashboardLayoutComponents/Tables/TableOrders.vue";
import PageNavigation from "../../../Shared/AdminDashboardLayoutComponents/PageNavigation.vue";
import CustomerDashboardLayoutVue from "../../../Shared/CustomerDashboard/CustomerDashboardLayout.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
