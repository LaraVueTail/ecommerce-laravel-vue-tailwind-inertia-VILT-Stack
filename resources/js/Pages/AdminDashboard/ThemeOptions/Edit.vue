<template>
  <section class="dark:bg-gray-900 h-screen overflow-x-hidden md:overflow-x-visible p-1">
    <div class="mx-auto max-w-screen-xl px-1 lg:px-12 my-11 pb-11">
      <!-- Modal content -->

      <Breadcrump :links="{ 'theme options': 'categories' }"></Breadcrump>
      <AlertDelete
        v-if="deleteAlertImage"
        @close="deleteAlertImage = false"
        @confirm="deleteHeroCarouselConfirm"
        :text="deleteAlertImageText"
      ></AlertDelete>

      <div
        class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5"
      >
        <!-- Modal header -->
        <ModalHeader :heading="'Theme Options'" :url="$page.url"></ModalHeader>
        <!-- Modal body -->
        <form action="#" @submit.prevent="">
          <div>
            <div class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-2">
              <div class="pr-5 md:border-r">
                <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                  Hero Slide Images
                </p>
                <div class="grid gap-4">
                  <FormFileUploadMultiple
                    @files-change="(files) => (hero_carousel = files)"
                    @files-delete="deleteHeroCarousel"
                    :label="'Upload Images'"
                    :oldImageUrls="JSON.parse(themeOption.hero_carousel)"
                    :name="'hero_carousel'"
                    :error="errors.hero_carousel"
                  >
                  </FormFileUploadMultiple>
                  <!-- <FormFileUploadMultiple
                    @filesChange="(files) => (this.themeOptionInfo.hero_carousel = files)"
                    :label="'Upload Images'"
                    :name="'hero_carousal'"
                    :error="errors.hero_carousel"
                  >
                  </FormFileUploadMultiple> -->
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
import { router, useForm } from "@inertiajs/vue3";
export default {
  props: ["errors", "themeOption"],
  data() {
    return {
      themeOptionInfo: this.themeOption,
      form: {},
      deleteAlertImage: false,
      deleteAlertImageText: "",
      imageUrl: null,
      hero_carousel: false,
    };
  },
  methods: {
    deleteHeroCarousel(imageUrl) {
      window.scrollTo(0, 0);
      this.deleteAlertImage = true;
      this.imageUrl = imageUrl;
      this.deleteAlertImageText = `Deleting the image will permanently removed from the database. You can't recover the
      image again. Are you sure about deleting?`;
      setTimeout(() => (this.deleteAlertImage = false), 5000);
    },
    deleteHeroCarouselConfirm() {
      router.put(
        `/admin-dashboard/theme-options/1/deleteImage`,
        {
          imageUrl: this.imageUrl,
        },
        {
          preserveState: false,
          preserveScroll: true,
          only: ["themeOption"],
        }
      );
      this.imageUrl = null;
    },
    updateThemeOptions() {
      if (this.hero_carousel) {
        this.themeOptionInfo.hero_carousel = this.hero_carousel;
      } else {
        delete this.themeOptionInfo.hero_carousel;
      }
      console.log(this.themeOptionInfo);
      this.themeOptionInfo._method = "put";
      router.post(`/admin-dashboard/theme-options/1`, this.themeOptionInfo, {
        preserveState: false,
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
import AlertDelete from "../../../Shared/AdminDashboardLayoutComponents/AlertDelete.vue";

import Button from "../../../Shared/AdminDashboardLayoutComponents/Button.vue";
import Errors from "../../../Shared/AdminDashboardLayoutComponents/Errors.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
