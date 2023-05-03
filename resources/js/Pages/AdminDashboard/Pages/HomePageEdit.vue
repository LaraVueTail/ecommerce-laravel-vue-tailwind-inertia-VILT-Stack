<template>
  <EditSectionLayout>
    <Breadcrump :links="{ Pages: null, 'Edit Home Page': null }"></Breadcrump>

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
                  :error="$page.props.errors['hero_carousel.0'] ?? ''"
                >
                </FormFileUploadMultiple>
              </div>
            </div>
            <div class="grid"></div>
          </div>
        </div>

        <div>
          <Errors :errors="$page.props.errors ?? false"></Errors>
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
  </EditSectionLayout>
  <!-- Modal content -->
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
  props: ["homePageContent"],
  data() {
    return {
      homePageContentInfo: this.homePageContent,
      hero_carousel: false,
      oldHeroCarousel: JSON.parse(this.homePageContent.hero_carousel_url),
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
      router.post(
        `/admin-dashboard/pages/home-page-content/1`,
        this.homePageContentInfo,
        {
          preserveState: false,
          preserveScroll: true,
          only: ["homePageContent", "flash", "errors"],
        }
      );
    },
  },
};
</script>

<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";

import ModalHeader from "../../../Shared/AdminDashboardLayoutComponents/ModalHeader.vue";
import FormFileUploadMultiple from "../../../Shared/FormComponents/FormFileUploadMultiple.vue";
import Button from "../../../Shared/FormComponents/Button.vue";
import Errors from "../../../Shared/FormComponents/Errors.vue";
import Breadcrump from "../../../Shared/AdminDashboardLayoutComponents/Breadcrump.vue";
import EditSectionLayout from "../../../Shared/AdminDashboardLayoutComponents/EditSectionLayout.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
