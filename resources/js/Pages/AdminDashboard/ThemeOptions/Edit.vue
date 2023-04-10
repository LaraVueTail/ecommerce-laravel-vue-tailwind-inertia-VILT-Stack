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
                    :oldImageUrls="oldHeroCarousel"
                    :name="'hero_carousel'"
                    :error="errors.hero_carousel"
                  >
                  </FormFileUploadMultiple>
                </div>
              </div>
              <div class="grid">
                <div>
                  <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                    About Page:
                  </p>
                  <FormInput
                    :label="'Heading'"
                    :name="'heading'"
                    :type="'text'"
                    :placeholder="'Page Heading'"
                    v-model="themeOptionInfo.aboutHeading"
                    :error="errors.aboutHeading"
                  ></FormInput>

                  <!-- <FormFileUploadSingle
                      @fileChange="(file) => (thumbnail = file)"
                      :label="'Thumbnail'"
                      :oldImageLink="oldThumbnail"
                      :name="'thumbnail'"
                      :error="errors.thumbnail ?? errors['thumbnail.0']"
                    ></FormFileUploadSingle> -->

                  <FormFileUploadSingle
                    @fileChange="(file) => (aboutImage = file)"
                    :label="'Image'"
                    :oldImageLink="oldAboutImage"
                    :name="'aboutImage'"
                    :error="errors.aboutImage ?? errors['aboutImage.0']"
                  ></FormFileUploadSingle>

                  <FormTextArea
                    :label="'Text'"
                    :name="'text'"
                    v-model="themeOptionInfo.aboutText"
                    :row="'5'"
                    :placeholder="'About page text content'"
                    :error="errors.aboutText"
                  >
                  </FormTextArea>

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
import { router, useRemember } from "@inertiajs/vue3";
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
      aboutImage: false,
      oldHeroCarousel: JSON.parse(this.themeOption.hero_carousel),
      oldAboutImage: this.themeOption.aboutImage,
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
        this.hero_carousel = false;
      } else {
        delete this.themeOptionInfo.hero_carousel;
      }

      if (this.aboutImage) {
        this.themeOptionInfo.aboutImage = this.aboutImage;
        this.oldAboutImage = URL.createObjectURL(this.aboutImage[0]);
      } else {
        delete this.themeOptionInfo.aboutImage;
      }
      console.log(this.themeOptionInfo);
      this.themeOptionInfo._method = "put";
      router.post(`/admin-dashboard/theme-options/1`, this.themeOptionInfo, {
        preserveState: false,
        preserveScroll: true,
        only: ["themeOption", "flash"],
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
import FormTextArea from "../../../Shared/AdminDashboardLayoutComponents/FormTextArea.vue";

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
