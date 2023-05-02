<template>
  <EditSectionLayout>
    <Breadcrump :links="{ Pages: null, 'More Pages': null }"></Breadcrump>
    <WebsiteContentsCustomPage
      v-for="customPage in customPages"
      :key="customPage.id"
      :customPageContent="customPage"
      :customPageContentsErrors="errors[`customPagesErrors_${customPage.id}`] ?? {}"
    ></WebsiteContentsCustomPage>
    <Button
      @click.prevent="addNewCustomPage()"
      :text="'+ Add New Page'"
      :color="'blue'"
      :fullWidth="true"
    ></Button>
  </EditSectionLayout>
  <!-- Modal content -->
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
  props: ["errors", "customPages"],
  data() {
    return {
      customPagesList: this.customPages,
    };
  },
  methods: {
    addNewCustomPage() {
      var newCustomPage = {};
      var pageId =
        Math.floor(Math.random() * (10000 - this.customPages.length)) +
        this.customPages.length;
      newCustomPage["name"] = " New Page-" + pageId;
      newCustomPage["slug"] = "new-page-" + pageId;
      newCustomPage["title"] = "New Page Title";
      router.post(`/admin-dashboard/pages/more-pages-store`, newCustomPage, {
        preserveState: true,
        preserveScroll: true,
        only: ["customPages", "flash", "errors"],
      });
    },
  },
};
</script>

<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";

import ModalHeader from "../../../Shared/AdminDashboardLayoutComponents/ModalHeader.vue";
import Breadcrump from "../../../Shared/AdminDashboardLayoutComponents/Breadcrump.vue";
import EditSectionLayout from "../../../Shared/AdminDashboardLayoutComponents/EditSectionLayout.vue";
import Button from "../../../Shared/AdminDashboardLayoutComponents/Button.vue";

import WebsiteContentsCustomPage from "../../../Shared/AdminDashboardLayoutComponents/WebsiteContentsCustomPage.vue";
import { router } from "@inertiajs/vue3";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
