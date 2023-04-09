<template>
      <section class="dark:bg-gray-900 h-screen overflow-x-hidden md:overflow-x-visible p-1">
    <div class="mx-auto max-w-screen-xl px-1 lg:px-12 my-11 pb-11">
      <!-- Modal content -->

      <Breadcrump
        :links="{ 'theme options': 'categories' }"
      ></Breadcrump>

      <div
        class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5"
      >
        <!-- Modal header -->
        <ModalHeader :heading="'Theme Options'" :url="$page.url"></ModalHeader>
        <!-- Modal body -->
        <form action="#" @submit.prevent="">
          <div>
            <div class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-2">
              <div class="pr-5 border-r">
                <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                  Hero Slide Images
                </p>
                <div class="grid gap-4">
                    <FormFileUploadMultiple
                      @filesChange="(files) => (this.themeOptionInfo.hero_carousel = files)"
                      :label="'Upload Images'"
                      :name="'hero_carousal'"
                      :error="errors.hero_carousel"
                    >
                    </FormFileUploadMultiple>
                </div>
              </div>
              <div class="grid">
                <div>
                  <p class="font-medium text-blue-600 dark:text-gray-400 my-4">Image:</p>

                  <!-- <FormFileUploadSingle
                    @fileChange="(file) => (this.categoryInfo.img = file)"
                    :label="'Image'"
                    :name="'image'"
                    :error="errors.img ?? errors['img.0']"
                  ></FormFileUploadSingle> -->
                </div>
              </div>
            </div>
          </div>

          <div>
            <Errors :errors="errors ?? false"></Errors>
            <div class="flex items-center space-x-4">
              <Button
                @click.prevent="updateThemeOptions()"
                :text="'Update Category'"
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
import { useForm } from "@inertiajs/vue3";
export default {
  props: ["errors"],
  data() {
    return {
      themeOptionInfo: {},
      form: {},
    };
  },
  methods: {
    updateThemeOptions() {
      console.log(this.themeOptionInfo);
      this.form = useForm(this.themeOptionInfo);
      this.form.post(`/admin-dashboard/theme-options/1`, {
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
import FormFileUploadSingle from "../../../Shared/AdminDashboardLayoutComponents/FormFileUploadSingle.vue";
import FormFileUploadMultiple from "../../../Shared/AdminDashboardLayoutComponents/FormFileUploadMultiple.vue";


import Button from "../../../Shared/AdminDashboardLayoutComponents/Button.vue";
import Errors from "../../../Shared/AdminDashboardLayoutComponents/Errors.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>