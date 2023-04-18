<template>
  <section class="dark:bg-gray-900 h-screen overflow-x-hidden md:overflow-x-visible p-1">
    <div class="mx-auto max-w-screen-xl px-1 lg:px-12 my-11 pb-11">
      <!-- Modal content -->

      <Breadcrump :links="{ 'Website Contents': null }"></Breadcrump>
      <AlertDelete
        v-if="deleteAlertImage"
        @close="deleteAlertImage = false"
        @confirm="deleteHeroCarouselConfirm"
        :text="deleteAlertImageText"
      ></AlertDelete>

      <h5 class="my-8 text-xl font-bold text-gray-700 dark:text-white tracking-tight">
        Website Contents
      </h5>

      <WebsiteContentsSiteIdentity
        :siteIdentity="siteIdentity"
        :siteIdentityErrors="errors.siteIdentityErrors ?? {}"
      ></WebsiteContentsSiteIdentity>

      <WebsiteContentsHomePage
        :homePageContent="homePageContent"
        :homePageContentsErrors="errors.homePageContentsErrors ?? {}"
      ></WebsiteContentsHomePage>

      <WebsiteContentsAboutPage
        :aboutPageContent="aboutPageContent"
        :aboutPageContentsErrors="errors.aboutPageContentsErrors ?? {}"
      ></WebsiteContentsAboutPage>

      <WebsiteContentsContactPage
        :contactPageContent="contactPageContent"
        :contactPageContentsErrors="errors.contactPageContentsErrors ?? {}"
      ></WebsiteContentsContactPage>
    </div>
  </section>
</template>
<script>
export default {
  props: [
    "errors",
    "aboutPageContent",
    "contactPageContent",
    "homePageContent",
    "siteIdentity",
  ],
  components: { WebsiteContentsSiteIdentity },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import WebsiteContentsHomePage from "../../../Shared/AdminDashboardLayoutComponents/WebsiteContentsHomePage.vue";
import WebsiteContentsAboutPage from "../../../Shared/AdminDashboardLayoutComponents/WebsiteContentsAboutPage.vue";
import WebsiteContentsContactPage from "../../../Shared/AdminDashboardLayoutComponents/WebsiteContentsContactPage.vue";
import Breadcrump from "../../../Shared/AdminDashboardLayoutComponents/Breadcrump.vue";
import AlertDelete from "../../../Shared/AdminDashboardLayoutComponents/AlertDelete.vue";
import WebsiteContentsSiteIdentity from "../../../Shared/AdminDashboardLayoutComponents/WebsiteContentsSiteIdentity.vue";
onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
