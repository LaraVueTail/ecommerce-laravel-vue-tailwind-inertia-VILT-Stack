<template>
  <EditSectionLayout>
    <Breadcrump :links="{ Pages: null, 'More Pages': null }"></Breadcrump>
    <WebsiteContentsCustomPage
      v-for="customPage in customPages"
      :key="customPage.id"
      :customPageContent="customPage"
      :customPageContentsErrors="errors[`customPagesErrors_${customPage.id}`] ?? {}"
    ></WebsiteContentsCustomPage>
  </EditSectionLayout>
  <!-- Modal content -->
</template>

<script>
export default {
  props: ["errors", "customPages"],
};
</script>

<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";

import ModalHeader from "../../../Shared/AdminDashboardLayoutComponents/ModalHeader.vue";
import Breadcrump from "../../../Shared/AdminDashboardLayoutComponents/Breadcrump.vue";
import EditSectionLayout from "../../../Shared/AdminDashboardLayoutComponents/EditSectionLayout.vue";

import WebsiteContentsCustomPage from "../../../Shared/AdminDashboardLayoutComponents/WebsiteContentsCustomPage.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
