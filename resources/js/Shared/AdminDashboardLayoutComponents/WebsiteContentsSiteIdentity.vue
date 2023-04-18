<template>
  <div
    class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5 my-10"
  >
    <!-- Modal header -->
    <ModalHeader :heading="'Site Identity'" :url="$page.url"></ModalHeader>
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
                v-model="siteIdentityInfo.siteName"
                :error="siteIdentityErrors.siteName"
              ></FormInput>
              <FormInput
                :label="'Site Domain'"
                :name="'site_domain'"
                :type="'text'"
                :placeholder="'laracommerce.com'"
                v-model="siteIdentityInfo.siteDomain"
                :error="siteIdentityErrors.siteDomain"
              ></FormInput>
              <FormInput
                :label="'Site Email'"
                :name="'site_email'"
                :type="'text'"
                :placeholder="'official@laracommerce.com'"
                v-model="siteIdentityInfo.siteEmail"
                :error="siteIdentityErrors.siteEmail"
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
                v-model="siteIdentityInfo.siteOwnerName"
                :error="siteIdentityErrors.siteOwnerName"
              ></FormInput>
              <FormInput
                :label="'Site Owner Email'"
                :name="'site_owner_email'"
                :type="'email'"
                :placeholder="'admin@laracommerce.com'"
                v-model="siteIdentityInfo.siteOwnerEmail"
                :error="siteIdentityErrors.siteOwnerEmail"
              ></FormInput>
            </div>
            <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
              E-Commerce Config
            </p>

            <div class="grid gap-4">
              <FormCheckBox
                :label="'Enable/Edit Stripe Payment'"
                :name="'enable_stripe'"
                :checked="siteIdentityInfo.enable_stripe"
                v-model="siteIdentityInfo.enable_stripe"
                :error="siteIdentityErrors.enable_stripe"
              >
              </FormCheckBox>
              <FormInput
                :label="'Stripe Secret Key'"
                :name="'stripe_secrete_key'"
                :type="'text'"
                :disabled="!siteIdentityInfo.enable_stripe"
                v-model="siteIdentityInfo.stripe_secret_key"
                :error="siteIdentityErrors.stripe_secret_key"
              ></FormInput>
              <FormSelectVue
                :label="'Choose currency'"
                :name="'currency'"
                v-model="siteIdentityInfo.currency"
                :selected="siteIdentityInfo.currency"
                :optionsArray="[
                  { value: 'usd', name: '&#x24;' },
                  { value: 'euro', name: '&#x20AC;' },
                  { value: 'yen', name: '&#xa5;' },
                  { value: 'inr', name: '&#x20B9;' },
                ]"
                :optionName="'name'"
                :optionValue="'value'"
              >
              </FormSelectVue>
            </div>
          </div>
          <div class="grid">
            <div>
              <FormFileUploadSingle
                @fileChange="(file) => (logoImage = file)"
                :label="'Logo Image'"
                :oldImageLink="oldLogoImage"
                :name="'logoImage'"
                :error="siteIdentityErrors.logoImage"
              ></FormFileUploadSingle>
            </div>
          </div>
        </div>
      </div>

      <div>
        <Errors :errors="siteIdentityErrors ?? false"></Errors>
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
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
  components: { FormCheckBox },
  props: ["siteIdentityErrors", "siteIdentity"],
  data() {
    return {
      siteIdentityInfo: this.siteIdentity,
      logoImage: false,
      oldLogoImage: this.siteIdentity.logo_image_url,
    };
  },
  methods: {
    updateSiteIdentity() {
      if (this.logoImage) {
        this.siteIdentityInfo.logoImage = this.logoImage[0];
        this.oldLogoImage = URL.createObjectURL(this.logoImage[0]);
      } else {
        delete this.siteIdentityInfo.logoImage;
      }
      this.siteIdentityInfo._method = "put";
      router.post(`/admin-dashboard/site-identity/1`, this.siteIdentityInfo, {
        preserveState: true,
        preserveScroll: true,
        only: ["siteIdentity", "flash", "errors"],
      });
    },
  },
};
</script>

<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import ModalHeader from "./ModalHeader.vue";
import FormTextArea from "./FormTextArea.vue";

import FormInput from "./FormInput.vue";
import FormFileUploadSingle from "./FormFileUploadSingle.vue";

import Button from "./Button.vue";
import Errors from "./Errors.vue";
import FormCheckBox from "./FormCheckBox.vue";

import FormSelectVue from "./FormSelect.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
