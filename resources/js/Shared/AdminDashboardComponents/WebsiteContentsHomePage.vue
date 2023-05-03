<template>
  <div
    class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5 my-10"
  >
    <!-- Modal header -->
    <ModalHeader :heading="'Home Page'" :url="$page.url"></ModalHeader>
    <!-- Modal body -->
    <form action="#" @submit.prevent="">
      <div>
        <div class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-2">
          <div class="pr-5">
            <p class="font-medium text-blue-600 dark:text-gray-400 my-4">Hero Slides</p>
            <div class="grid gap-4">
              <FormFileUploadMultiple
                @files-change="(files) => (hero_carousel = files)"
                @files-delete="deleteHeroCarousel"
                :label="'Upload Images'"
                :oldImageUrls="oldHeroCarousel"
                :deleteImageUrl="'/admin-dashboard/home-page-contents/1/deleteImage'"
                :preserveStateData="'homePageContent'"
                :name="'hero_carousel'"
                :error="errors.hero_carousel"
              >
              </FormFileUploadMultiple>
            </div>
          </div>
          <div class="grid"></div>
        </div>
      </div>

      <div>
        <Errors :errors="homePageContentsErrors ?? false"></Errors>
        <div class="flex items-center space-x-4">
          <Button
            @click.prevent="updateHomePageContent()"
            :text="'Update Home Page'"
            :color="'blue'"
          ></Button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
  props: ["homePageContentsErrors", "homePageContent"],
  data() {
    return {
      homePageContentInfo: this.homePageContent,
      hero_carousel: false,
      oldHeroCarousel: JSON.parse(this.homePageContent.hero_carousel_url),
      errors: this.homePageContentsErrors ?? {},
    };
  },
  methods: {
    updateHomePageContent() {
      if (this.hero_carousel) {
        this.homePageContentInfo.hero_carousel = this.hero_carousel;
      } else {
        delete this.homePageContentInfo.hero_carousel;
      }
      this.homePageContentInfo._method = "put";
      router.post(`/admin-dashboard/home-page-contents/1`, this.homePageContentInfo, {
        preserveState: false,
        preserveScroll: true,
        only: ["homePageContent", "flash", "errors"],
      });
    },
  },
};
</script>

<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import ModalHeader from "./ModalHeader.vue";
import FormFileUploadMultiple from "../FormComponents/FormFileUploadMultiple.vue";

import FormTextArea from "../FormComponents/FormTextArea.vue";

import FormInput from "../FormComponents/FormInput.vue";
import FormFileUploadSingle from "../FormComponents/FormFileUploadSingle.vue";

import Button from "../FormComponents/Button.vue";
import Errors from "../FormComponents/Errors.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
