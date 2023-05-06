<template>
  <section class="dark:bg-gray-900 h-screen overflow-x-hidden md:overflow-x-visible p-1">
    <div class="mx-auto max-w-screen-xl px-1 lg:px-12 my-11 pb-11">
      <!-- Modal content -->

      <Breadcrump
        :links="{ categories: 'categories', 'Create Category': '' }"
      ></Breadcrump>

      <div
        class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5"
      >
        <!-- Modal header -->
        <ModalHeader :heading="'Create Category'" :url="$page.url"></ModalHeader>
        <!-- Modal body -->
        <form action="#" @submit.prevent="">
          <div>
            <div class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-2">
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
                    @fileChange="(file) => (this.categoryInfo.img = file[0])"
                    :label="'Image'"
                    :name="'image'"
                    :error="errors.img"
                  ></FormFileUploadSingle>
                </div>
              </div>
            </div>
          </div>

          <div>
            <Errors :errors="errors ?? false"></Errors>
            <div class="flex items-center space-x-4">
              <Button
                @click.prevent="createCategory()"
                :text="'Create Category'"
                :color="'blue'"
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
  props: ["errors"],
  data() {
    return {
      categoryInfo: {},
      form: {},
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
    createCategory() {
      this.form = useForm(this.categoryInfo);
      console.log(this.categoryInfo);
      this.form.post(`/admin-dashboard/categories`, {
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
import FormFileUploadSingle from "../../../Shared/FormComponents/FormFileUploadSingle.vue";

import Button from "../../../Shared/FormComponents/Button.vue";
import Errors from "../../../Shared/FormComponents/Errors.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
