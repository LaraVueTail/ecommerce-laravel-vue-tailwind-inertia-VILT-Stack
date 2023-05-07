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
                  v-model="contactPageContentInfo.contact_heading"
                  :error="$page.props.errors.contact_heading ?? ''"
                ></FormInput>
                <FormTextArea
                  :label="'Sub Heading'"
                  :name="'sub_heading'"
                  v-model="contactPageContentInfo.contact_sub_heading"
                  :row="'3'"
                  :placeholder="'Contact page text content'"
                  :error="$page.props.errors.contact_sub_heading ?? ''"
                >
                </FormTextArea>

                <FormTextEditor
                  v-model="contactPageContentInfo.contact_text"
                  :label="'Page Content'"
                  :name="'text'"
                  :error="$page.props.errors.contact_text ?? ''"
                ></FormTextEditor>
              </div>
            </div>
            <div class="grid">
              <div>
                <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                  Contact Page:
                </p>
                <FormFileUploadSingle
                  @fileChange="(file) => (contact_image = file[0])"
                  :label="'Image'"
                  :oldImageLink="oldContactImage"
                  :name="'contactImage'"
                  :error="$page.props.errors.contact_image ?? ''"
                ></FormFileUploadSingle>
                <FormInput
                  :label="'Phone Numbers'"
                  :name="'phone_numbers'"
                  :type="'text'"
                  :placeholder="''"
                  v-model="contactPageContentInfo.contact_phone_numbers"
                  :error="$page.props.errors.contact_phone_numbers ?? ''"
                ></FormInput>
                <FormInput
                  :label="'Email'"
                  :name="'email'"
                  :type="'text'"
                  :placeholder="''"
                  v-model="contactPageContentInfo.contact_email"
                  :error="$page.props.errors.contact_email ?? ''"
                ></FormInput>
                <FormInput
                  :label="'Address'"
                  :name="'address'"
                  :type="'text'"
                  :placeholder="''"
                  v-model="contactPageContentInfo.contact_address"
                  :error="$page.props.errors.contact_address ?? ''"
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
      contact_image: false,
      oldContactImage: this.contactPageContent.contact_image_url,
      errors: this.contactPageContentsErrors ?? {},
    };
  },
  methods: {
    updateContactPageContent() {
      if (this.contact_image) {
        this.contactPageContentInfo.contact_image = this.contact_image;
        this.oldContactImage = URL.createObjectURL(this.contact_image);
      } else {
        delete this.contactPageContentInfo.contact_image;
      }
      this.contactPageContentInfo._method = "put";
      router.post(
        `/admin-dashboard/pages/contact-page-content`,
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

import ModalHeader from "../../../Shared/AdminDashboardComponents/ModalHeader.vue";
import Button from "../../../Shared/FormComponents/Button.vue";
import Errors from "../../../Shared/FormComponents/Errors.vue";
import Breadcrump from "../../../Shared/AdminDashboardComponents/Breadcrump.vue";
import EditSectionLayout from "../../../Shared/AdminDashboardComponents/EditSectionLayout.vue";
import FormFileUploadSingle from "../../../Shared/FormComponents/FormFileUploadSingle.vue";
import FormTextArea from "../../../Shared/FormComponents/FormTextArea.vue";
import FormInput from "../../../Shared/FormComponents/FormInput.vue";
import FormTextEditor from "../../../Shared/FormComponents/FormTextEditor.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
