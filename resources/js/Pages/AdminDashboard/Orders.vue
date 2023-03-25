<template>
    <section class="dark:bg-gray-900 w-full h-screen overflow-x-hidden md:overflow-x-visible p-1">
        <div class="mx-auto max-w-screen-xl px-1 lg:px-12">
            <!-- Start coding here -->
            <h1 class="text-2xl text-gray-800 mb-6 font-poppins p-3 sm:p-5">
                Orders
            </h1>

            <button
                type="button"
                class="my-3 flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 28 28"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15"
                    />
                </svg>

                Add New Order
            </button>

            <div
                class="bg-white dark:bg-gray-800 relative shadow-md rounded-lg border-2 border-gray-200"
            >
                <Filters :filters="filters"></Filters>

                <OrdersTable :orders="orders"></OrdersTable>

                <PageNavigation :orders="orders"></PageNavigation>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ["orders", "filters"],
};
</script>
<script setup>
import { onMounted,onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import Filters from "../../Shared/Filters/Filters.vue";
import OrdersTable from "../../Shared/AdminDashboardLayoutComponents/OrdersTable.vue";
import PageNavigation from "../../Shared/AdminDashboardLayoutComponents/PageNavigation.vue";
onMounted(() => {
    initFlowbite();
});
onUpdated(() => {
    initFlowbite();
})
</script>
