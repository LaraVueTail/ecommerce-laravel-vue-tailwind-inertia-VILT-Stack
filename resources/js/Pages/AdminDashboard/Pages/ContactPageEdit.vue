<template>
  <EditSectionLayout>
    <Breadcrump :links="{ Pages: null, 'Edit Contact Page': null }"></Breadcrump>

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
              <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                Text Contents
              </p>
              <div class="grid gap-4">
                <FormInput
                  :label="'Heading'"
                  :name="'heading'"
                  :type="'text'"
                  :placeholder="'Page Heading'"
                  v-model="contactPageContentInfo.contactHeading"
                  :error="$page.props.errors.contactHeading ?? ''"
                ></FormInput>
                <FormTextArea
                  :label="'Sub Heading'"
                  :name="'sub_heading'"
                  v-model="contactPageContentInfo.contactSubHeading"
                  :row="'3'"
                  :placeholder="'Contact page text content'"
                  :error="$page.props.errors.contactSubHeading ?? ''"
                >
                </FormTextArea>

                <FormTextEditor
                  v-model="contactPageContentInfo.contactText"
                  :label="'Page Content'"
                  :name="'text'"
                  :error="$page.props.errors.contactText ?? ''"
                ></FormTextEditor>
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
                  :error="$page.props.errors.contactImage ?? ''"
                ></FormFileUploadSingle>
                <FormInput
                  :label="'Phone Numbers'"
                  :name="'phone_numbers'"
                  :type="'text'"
                  :placeholder="''"
                  v-model="contactPageContentInfo.contactPhoneNumbers"
                  :error="$page.props.errors.contactPhoneNumbers ?? ''"
                ></FormInput>
                <FormInput
                  :label="'Email'"
                  :name="'email'"
                  :type="'text'"
                  :placeholder="''"
                  v-model="contactPageContentInfo.contactEmail"
                  :error="$page.props.errors.contactEmail ?? ''"
                ></FormInput>
                <FormInput
                  :label="'Address'"
                  :name="'address'"
                  :type="'text'"
                  :placeholder="''"
                  v-model="contactPageContentInfo.contactAddress"
                  :error="$page.props.errors.contactAddress ?? ''"
                ></FormInput>
              </div>
            </div>
          </div>
        </div>

        <div>
          <Errors :errors="$page.props.errors ?? false"></Errors>
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
  </EditSectionLayout>
  <!-- Modal content -->
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
  props: ["contactPageContentsErrors", "contactPageContent"],
  data() {
    return {
      contactPageContentInfo: this.contactPageContent,
      contactImage: false,
      oldContactImage: this.contactPageContent.contact_image_url,
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
        `/admin-dashboard/pages/contact-page-content/1`,
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

import ModalHeader from "../../../Shared/AdminDashboardLayoutComponents/ModalHeader.vue";
import Button from "../../../Shared/AdminDashboardLayoutComponents/Button.vue";
import Errors from "../../../Shared/AdminDashboardLayoutComponents/Errors.vue";
import Breadcrump from "../../../Shared/AdminDashboardLayoutComponents/Breadcrump.vue";
import EditSectionLayout from "../../../Shared/AdminDashboardLayoutComponents/EditSectionLayout.vue";
import FormFileUploadSingle from "../../../Shared/AdminDashboardLayoutComponents/FormFileUploadSingle.vue";
import FormTextArea from "../../../Shared/AdminDashboardLayoutComponents/FormTextArea.vue";
import FormInput from "../../../Shared/AdminDashboardLayoutComponents/FormInput.vue";
import FormTextEditor from "../../../Shared/AdminDashboardLayoutComponents/FormTextEditor.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
