<template>
  <section
    class="dark:bg-gray-900 w-full h-screen overflow-x-hidden md:overflow-x-visible p-1"
  >
    <div class="mx-auto max-w-screen-xl px-1 lg:px-12 pb-10">
      <!-- Start coding here -->
      <h1 class="text-2xl text-gray-800 mb-2 font-poppins py-3 sm:py-2 font-medium">
        Categories
      </h1>

      <AlertDelete
        v-if="deleteAlertCategory"
        @close="deleteAlertCategory = false"
        @confirm="deleteCategoryConfirm()"
        :text="deleteAlertCategoryText"
      ></AlertDelete>

      <div class="my-2">
        <Button
          @click.prevent="router.visit('/admin-dashboard/categories/create')"
          :text="'+ Add Category'"
          :color="'blue'"
        ></Button>
      </div>

      <div
        class="bg-white dark:bg-gray-800 relative shadow-md rounded-lg border-2 border-gray-200"
      >
        <Filters
          :searchPlaceHolder="'Search by Category ID or Name'"
          :filters="filters"
          :currentPage="categories.current_page"
          :dataName="'categories'"
          :enableFilters="{
            search: true,
          }"
        ></Filters>

        <TableCategories
          :categories="categories"
          @deleteCategory="deleteCategory"
        ></TableCategories>

        <PageNavigation :data="categories"></PageNavigation>
      </div>
    </div>
  </section>
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
  props: ["categories", "filters"],
  data() {
    return {
      deleteAlertCategory: false,
      deleteAlertCategoryText: "",
      categoryId: null,
    };
  },
  methods: {
    deleteCategory(categoryId) {
      window.scrollTo(0, 0);
      this.deleteAlertCategory = true;
      this.categoryId = categoryId;
      this.deleteAlertCategoryText = `Deleting the category will permanently removed from the database. You can't recover the
        category again. Are you sure about deleting?`;
      setTimeout(() => (this.deleteAlertCategory = false), 5000);
    },
    deleteCategoryConfirm() {
      router.delete(`/admin-dashboard/categories/${this.categoryId}`, {
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
import TableCategories from "../../../Shared/Tables/TableCategories.vue";
import PageNavigation from "../../../Shared/AdminDashboardComponents/PageNavigation.vue";
import AlertDelete from "../../../Shared/AdminDashboardComponents/AlertDelete.vue";
onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
