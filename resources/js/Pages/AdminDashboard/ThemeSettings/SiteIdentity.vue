<template>
  <EditSectionLayout>
    <Breadcrump
      :links="{ 'Theme Settings': null, 'Edit Logo and Site Info': null }"
    ></Breadcrump>

    <div
      class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5 my-10"
    >
      <!-- Modal header -->
      <ModalHeader :heading="'Logo and Site Info'" :url="$page.url"></ModalHeader>
      <!-- Modal body -->
      <form action="#" @submit.prevent="">
        <div>
          <div class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-3">
            <div class="pr-5 md:border-r">
              <p class="font-medium text-blue-600 dark:text-gray-400 my-4">Site Info</p>
              <div class="grid gap-4">
                <FormInput
                  :label="'Site Name'"
                  :name="'site_name'"
                  :type="'text'"
                  :placeholder="'Lara Commerce'"
                  v-model="siteIdentityInfo.site_name"
                  :error="$page.props.errors.site_name"
                ></FormInput>
                <FormInput
                  :label="'Site Domain'"
                  :name="'site_domain'"
                  :type="'text'"
                  :placeholder="'laracommerce.com'"
                  v-model="siteIdentityInfo.site_domain"
                  :error="$page.props.errors.site_domain"
                ></FormInput>
                <FormInput
                  :label="'Site Email'"
                  :name="'site_email'"
                  :type="'text'"
                  :placeholder="'official@laracommerce.com'"
                  v-model="siteIdentityInfo.site_email"
                  :error="$page.props.errors.site_email"
                ></FormInput>
              </div>
            </div>
            <div class="pr-5 md:border-r">
              <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                Site Owner Info
              </p>

              <div class="grid gap-4">
                <FormInput
                  :label="'Site Owner Name'"
                  :name="'site_owner_name'"
                  :type="'text'"
                  v-model="siteIdentityInfo.site_owner_name"
                  :error="$page.props.errors.site_owner_name"
                ></FormInput>
                <FormInput
                  :label="'Site Owner Email'"
                  :name="'site_owner_email'"
                  :type="'email'"
                  :placeholder="'admin@laracommerce.com'"
                  v-model="siteIdentityInfo.site_owner_email"
                  :error="$page.props.errors.site_owner_email"
                ></FormInput>
              </div>
            </div>
            <div class="grid">
              <div>
                <FormFileUploadSingle
                  @fileChange="(file) => (logo_image = file[0])"
                  :label="'Logo Image'"
                  :oldImageLink="oldLogoImage"
                  :name="'logoImage'"
                  :error="$page.props.errors.logo_image"
                ></FormFileUploadSingle>
              </div>
            </div>
          </div>
        </div>

        <div>
          <Errors :errors="$page.props.errors ?? false"></Errors>
          <div class="flex items-center space-x-4">
            <Button
              @click.prevent="updateSiteIdentity()"
              :text="'Update Site Identity'"
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
  components: { FormCheckBox },
  props: ["siteIdentity"],
  data() {
    return {
      siteIdentityInfo: this.siteIdentity,
      logo_image: false,
      oldLogoImage: this.siteIdentity.logo_image_url,
    };
  },
  //   computed: {
  //     currenciesArray() {
  //       var currenciesArray = [];
  //       var inputArray = JSON.parse(this.siteIdentityInfo.available_currencies);
  //       console.log(inputArray);
  //       Object.keys(inputArray).forEach(function (key, index) {
  //         currenciesArray.push({
  //           value: key,
  //           name: inputArray[key],
  //         });
  //       });
  //       console.log(this.currenciesArray);
  //       return currenciesArray;
  //     },
  //   },
  methods: {
    updateSiteIdentity() {
      if (this.logo_image) {
        this.siteIdentityInfo.logo_image = this.logo_image;
        this.oldLogoImage = URL.createObjectURL(this.logo_image);
      } else {
        delete this.siteIdentityInfo.logo_image;
      }
      this.siteIdentityInfo._method = "put";
      router.post(
        `/admin-dashboard/theme-settings/site-identity`,
        this.siteIdentityInfo,
        {
          preserveState: true,
          preserveScroll: true,
          only: ["siteIdentity", "flash", "errors"],
        }
      );
    },
  },
};
</script>

<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";

import ModalHeader from "../../../Shared/AdminDashboardComponents/ModalHeader.vue";
import Button from "../../../Shared/FormComponents/Button.vue";
import Errors from "../../../Shared/FormComponents/Errors.vue";
import Breadcrump from "../../../Shared/AdminDashboardComponents/Breadcrump.vue";
import EditSectionLayout from "../../../Shared/AdminDashboardComponents/EditSectionLayout.vue";
import FormFileUploadSingle from "../../../Shared/FormComponents/FormFileUploadSingle.vue";
import FormInput from "../../../Shared/FormComponents/FormInput.vue";
import FormCheckBox from "../../../Shared/FormComponents/FormCheckBox.vue";
import FormSelect from "../../../Shared/FormComponents/FormSelect.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
