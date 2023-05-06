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
            <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2">
              <div class="pr-5 border-r">
                <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                  Category Details:
                </p>
                <div class="grid gap-4">
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
              <div class="grid">
                <div>
                  <p class="font-medium text-blue-600 dark:text-gray-400 my-4">Image:</p>

                  <FormFileUploadSingle
                    @fileChange="(file) => (this.img = file[0])"
                    :label="'Image'"
                    :oldImageLink="this.categoryInfo.category_image_url"
                    :name="'image'"
                    :error="errors.img ?? errors['img.0']"
                  ></FormFileUploadSingle>
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
                :disableFlash="true"
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
      img: false,
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
      if (this.img) {
        this.categoryInfo.img = this.img;
      } else {
        delete this.categoryInfo.img;
      }
      console.log(this.categoryInfo);
      this.categoryInfo._method = "put";
      router.post(`/admin-dashboard/categories/${this.category.id}`, this.categoryInfo, {
        preserveState: true,
        only: ["category", "flash", "errors"],
        preserveScroll: true,
      });
    },
  },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import Breadcrump from "../../../Shared/AdminDashboardComponents/Breadcrump.vue";
import ModalHeader from "../../../Shared/AdminDashboardComponents/ModalHeader.vue";
import FormInput from "../../../Shared/FormComponents/FormInput.vue";
import Button from "../../../Shared/FormComponents/Button.vue";
import Errors from "../../../Shared/FormComponents/Errors.vue";
import AlertDelete from "../../../Shared/AdminDashboardComponents/AlertDelete.vue";
import FormFileUploadSingle from "../../../Shared/FormComponents/FormFileUploadSingle.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
