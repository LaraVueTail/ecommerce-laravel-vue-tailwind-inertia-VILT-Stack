<template>
  <section class="dark:bg-gray-900 h-screen overflow-x-hidden md:overflow-x-visible p-1">
    <div class="mx-auto max-w-screen-xl px-1 lg:px-12 my-11 pb-11">
      <!-- Modal content -->

      <Breadcrump :links="{ categories: 'categories', 'Edit Category': '' }"></Breadcrump>
      <AlertDelete
        v-if="deleteAlertCategory"
        @close="deleteAlertCategory = false"
        @confirm="deleteCategoryConfirm()"
        :text="deleteAlertCategoryText"
      ></AlertDelete>

      <div
        class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5"
      >
        <!-- Modal header -->
        <ModalHeader
          :heading="`Edit Category - #${category.id}`"
          :url="$page.url"
        ></ModalHeader>
        <!-- Modal body -->
        <form action="#" @submit.prevent="">
          <div>
            <div class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-3">
              <div class="pr-5 col-span-2">
                <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                  Category Details:
                </p>
                <div class="grid gap-4 sm:grid-cols-2">
                  <FormInput
                    :label="'Category Name'"
                    :name="'category_name'"
                    :type="'text'"
                    :error="errors.name"
                    @change="changeNameToSlug"
                    v-model="categoryInfo.name"
                  ></FormInput>
                  <FormInput
                    :label="'Category Slug'"
                    :name="'category_slug'"
                    :type="'text'"
                    :error="errors.slug"
                    @change="changeToSlug()"
                    v-model="categoryInfo.slug"
                  ></FormInput>
                </div>
              </div>
            </div>
          </div>

          <div>
            <Errors :errors="errors ?? false"></Errors>
            <div class="flex items-center space-x-4">
              <Button
                @click.prevent="updateCategory()"
                :text="'Update Category'"
                :color="'blue'"
              ></Button>
              <Button
                @click.prevent="deleteCategory()"
                :text="'Delete Category'"
                :color="'red'"
              ></Button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
import { router } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
export default {
  props: ["category", "errors"],
  data() {
    return {
      categoryInfo: this.category,
      form: {},
      deleteAlertCategory: false,
      deleteAlertCategoryText: "",
    };
  },
  methods: {
    slugify(str) {
      return str
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, "")
        .replace(/[\s_-]+/g, "-")
        .replace(/^-+|-+$/g, "");
    },
    changeNameToSlug() {
      this.categoryInfo.slug = this.slugify(this.categoryInfo.name);
    },
    changeToSlug() {
      if (this.categoryInfo.slug !== "") {
        this.categoryInfo.slug = this.slugify(this.categoryInfo.slug);
      } else {
        this.categoryInfo.slug = this.slugify(this.categoryInfo.name);
      }
    },
    deleteCategory() {
      window.scrollTo(0, 0);
      this.deleteAlertCategory = true;
      this.deleteAlertCategoryText = `Deleting the category will permanently removed from the database. You can't recover the
        category again. Are you sure about deleting?`;
      setTimeout(() => (this.deleteAlertCategory = false), 5000);
    },
    deleteCategoryConfirm() {
      router.delete(`/admin-dashboard/categories/${this.category.id}`, {
        preserveState: false,
      });
    },
    updateCategory() {
      this.form = useForm(this.categoryInfo);
      console.log(this.categoryInfo);
      this.form.put(`/admin-dashboard/categories/${this.category.id}`, {
        preserveScroll: true,
      });
    },
  },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import Breadcrump from "../../../Shared/AdminDashboardLayoutComponents/Breadcrump.vue";
import ModalHeader from "../../../Shared/AdminDashboardLayoutComponents/ModalHeader.vue";
import FormInput from "../../../Shared/AdminDashboardLayoutComponents/FormInput.vue";
import Button from "../../../Shared/AdminDashboardLayoutComponents/Button.vue";
import Errors from "../../../Shared/AdminDashboardLayoutComponents/Errors.vue";
import AlertDelete from "../../../Shared/AdminDashboardLayoutComponents/AlertDelete.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
