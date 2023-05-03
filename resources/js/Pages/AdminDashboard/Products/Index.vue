<template>
  <section
    class="dark:bg-gray-900 w-full h-screen overflow-x-hidden md:overflow-x-visible p-1"
  >
    <div class="mx-auto max-w-screen-xl px-1 lg:px-12">
      <!-- Start coding here -->
      <h1 class="text-2xl text-gray-800 mb-2 font-poppins py-3 sm:py-2 font-medium">
        Products
      </h1>

      <AlertDelete
        v-if="deleteAlertProduct"
        @close="deleteAlertProduct = false"
        @confirm="deleteProductConfirm()"
        :text="deleteAlertProductText"
      ></AlertDelete>

      <Link href="/admin-dashboard/products/create">
        <button
          type="button"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
        >
          + Add Product
        </button>
      </Link>

      <div
        class="bg-white dark:bg-gray-800 relative shadow-md rounded-lg border-2 border-gray-200"
      >
        <Filters
          :searchPlaceHolder="'Search by Product ID, Name, Description..'"
          :filters="filters"
          :currentPage="products.current_page"
          :dataName="'products'"
          :sortByFilters="{ dateSort: true, priceSort: true }"
          :enableFilters="{
            search: true,
            dateRange: true,
            sortBy: true,
            filterBy: { availability: true, tag: true },
          }"
        ></Filters>

        <TableProducts
          :products="products"
          @deleteProduct="deleteProduct"
        ></TableProducts>

        <PageNavigation :data="products"></PageNavigation>
      </div>
    </div>
  </section>
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
  props: ["products", "filters"],
  data() {
    return {
      deleteAlertProduct: false,
      deleteAlertProductText: "",
      productId: null,
    };
  },
  methods: {
    deleteProduct(productId) {
      window.scrollTo(0, 0);
      this.deleteAlertProduct = true;
      this.productId = productId;
      this.deleteAlertProductText = `Deleting the product will permanently removed from the database. You can't recover the
      product again. Are you sure about deleting?`;
      setTimeout(() => (this.deleteAlertProduct = false), 5000);
    },
    deleteProductConfirm() {
      router.delete(`/admin-dashboard/products/${this.productId}`, {
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
import TableProducts from "../../../Shared/Tables/TableProducts.vue";
import PageNavigation from "../../../Shared/AdminDashboardComponents/PageNavigation.vue";
import AlertDelete from "../../../Shared/AdminDashboardComponents/AlertDelete.vue";
onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
