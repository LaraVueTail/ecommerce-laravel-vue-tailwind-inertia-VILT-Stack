<template>
  <div
    class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5 my-10"
  >
    <!-- Modal header -->
    <ModalHeader :heading="'Contact Page'" :url="$page.url"></ModalHeader>
    <!-- Modal body -->
    <form action="#" @submit.prevent="">
      <div>
        <div class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-2">
          <div class="pr-5 md:border-r">
            <p class="font-medium text-blue-600 dark:text-gray-400 my-4">Text Contents</p>
            <div class="grid gap-4">
              <FormInput
                :label="'Heading'"
                :name="'heading'"
                :type="'text'"
                :placeholder="'Page Heading'"
                v-model="contactPageContentInfo.contactHeading"
                :error="this.contactPageContentsErrors.contactHeading"
              ></FormInput>
              <FormTextArea
                :label="'Sub Heading'"
                :name="'sub_heading'"
                v-model="contactPageContentInfo.contactSubHeading"
                :row="'3'"
                :placeholder="'Contact page text content'"
                :error="this.contactPageContentsErrors.contactSubHeading"
              >
              </FormTextArea>
              <FormTextArea
                :label="'Main Paragraph'"
                :name="'text'"
                v-model="contactPageContentInfo.aboutText"
                :row="'5'"
                :placeholder="'Contact page text content'"
                :error="this.contactPageContentsErrors.aboutText"
              >
              </FormTextArea>
            </div>
          </div>
          <div class="grid">
            <div>
              <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                Contact Page:
              </p>
              <FormFileUploadSingle
                @fileChange="(file) => (contactImage = file)"
                :label="'Image'"
                :oldImageLink="oldContactImage"
                :name="'contactImage'"
                :error="this.contactPageContentsErrors.contactImage"
              ></FormFileUploadSingle>
              <FormInput
                :label="'Phone Numbers'"
                :name="'phone_numbers'"
                :type="'text'"
                :placeholder="''"
                v-model="contactPageContentInfo.contactPhoneNumbers"
                :error="this.contactPageContentsErrors.contactPhoneNumbers"
              ></FormInput>
              <FormInput
                :label="'Email'"
                :name="'email'"
                :type="'text'"
                :placeholder="''"
                v-model="contactPageContentInfo.contactEmail"
                :error="this.contactPageContentsErrors.contactEmail"
              ></FormInput>
              <FormInput
                :label="'Address'"
                :name="'address'"
                :type="'text'"
                :placeholder="''"
                v-model="contactPageContentInfo.contactAddress"
                :error="this.contactPageContentsErrors.contactAddress"
              ></FormInput>
            </div>
          </div>
        </div>
      </div>

      <div>
        <Errors :errors="contactPageContentsErrors ?? false"></Errors>
        <div class="flex items-center space-x-4">
          <Button
            @click.prevent="updateContactPageContent()"
            :text="'Update Contact Page'"
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
  props: ["contactPageContentsErrors", "contactPageContent"],
  data() {
    return {
      contactPageContentInfo: this.contactPageContent,
      contactImage: false,
      oldContactImage: this.contactPageContent.contactImage,
      errors: this.contactPageContentsErrors ?? {},
    };
  },
  methods: {
    updateContactPageContent() {
      if (this.contactImage) {
        this.contactPageContentInfo.contactImage = this.contactImage;
        this.oldContactImage = URL.createObjectURL(this.contactImage[0]);
      } else {
        delete this.contactPageContentInfo.contactImage;
      }
      this.contactPageContentInfo._method = "put";
      router.post(
        `/admin-dashboard/contact-page-contents/1`,
        this.contactPageContentInfo,
        {
          preserveState: true,
          preserveScroll: true,
          only: ["contactPageContent", "flash", "errors"],
        }
      );
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

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
