<template>
  <div
    class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5 my-10"
  >
    <AlertDelete
      v-if="deleteAlertPage"
      @close="deleteAlertPage = false"
      @confirm="deletePageConfirm"
      :text="deleteAlertPageText"
    ></AlertDelete>

    <!-- Modal header -->
    <ModalHeader
      :heading="`Custom Page - ${customPageContentInfo.name}`"
      :url="$page.url"
    ></ModalHeader>
    <!-- Modal body -->
    <form action="#" @submit.prevent="">
      <div>
        <div class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-2">
          <div class="pr-5 md:border-r">
            <p class="font-medium text-blue-600 dark:text-gray-400 my-4">Text Contents</p>
            <div class="grid gap-4">
              <FormInput
                :label="'Page Name'"
                :name="'name'"
                :type="'text'"
                :placeholder="'Page Name'"
                v-model="customPageContentInfo.name"
                @change="changeNameToSlug()"
                :error="customPageContentsErrors.name"
              ></FormInput>
              <FormInput
                :label="'Page Slug'"
                :name="'slug'"
                :type="'text'"
                @change="changeToSlug()"
                :placeholder="'page_slug'"
                v-model="customPageContentInfo.slug"
                :error="customPageContentsErrors.slug"
              ></FormInput>
              <FormInput
                :label="'Page Link'"
                :name="'link'"
                :type="'text'"
                :placeholder="'page_slug'"
                :readOnly="customPageContentInfo.page_link"
                :disabled="true"
              ></FormInput>
              <FormInput
                :label="'Title'"
                :name="'title'"
                :type="'text'"
                :placeholder="'Page Title'"
                v-model="customPageContentInfo.title"
                :error="customPageContentsErrors.title"
              ></FormInput>
              <FormTextArea
                :label="'Sub title'"
                :name="'sub_title'"
                v-model="customPageContentInfo.sub_title"
                :row="'3'"
                :placeholder="'Sub title'"
                :error="customPageContentsErrors.sub_title"
              >
              </FormTextArea>
            </div>
          </div>
          <div class="grid">
            <div>
              <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                custom Page:
              </p>
              <FormFileUploadSingle
                @fileChange="(file) => (image = file)"
                :label="'Image'"
                :oldImageLink="oldImage"
                :name="'image'"
                :error="customPageContentsErrors.image"
              ></FormFileUploadSingle>
            </div>
            <FormTextEditor
              v-model="customPageContentInfo.content"
              :label="'Main Content'"
              :name="'main_content'"
              :error="customPageContentsErrors.content"
            ></FormTextEditor>
          </div>
        </div>
      </div>

      <div>
        <Errors :errors="customPageContentsErrors ?? false"></Errors>
        <div class="flex items-center space-x-4">
          <Button
            @click.prevent="updateCustomPageContent()"
            :text="'Update Page'"
            :disableFlash="false"
            :color="'blue'"
          ></Button>
          <Button
            @click.prevent="router.get(customPageContentInfo.page_link)"
            :text="'Visit Page'"
            :color="'blue'"
            :disableFlash="true"
          ></Button>
          <Button
            @click.prevent="deletePage(customPageContentInfo.id)"
            :text="'Delete Page'"
            :color="'red'"
            :disableFlash="true"
          ></Button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
  props: ["customPageContentsErrors", "customPageContent"],
  data() {
    return {
      customPageContentInfo: this.customPageContent,
      image: false,
      oldImage: this.customPageContent.image_url,
      errors: this.customPageContentsErrors ?? {},
      deleteAlertPage: false,
      deleteAlertPageText: "",
      deleteAlertPageId: null,
    };
  },
  methods: {
    slugify(str) {
      return str
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, "")
        .replace(/[\s_-]+/g, "-")
        .replace(/^-+|-+$/g, "");
    },
    changeNameToSlug() {
      this.customPageContentInfo.slug = this.slugify(this.customPageContentInfo.name);
    },
    changeToSlug() {
      if (this.customPageContentInfo.slug !== "") {
        this.customPageContentInfo.slug = this.slugify(this.customPageContentInfo.slug);
      } else {
        this.customPageContentInfo.slug = this.slugify(this.customPageContentInfo.name);
      }
    },
    deletePage(id) {
      window.scrollTo(0, 0);
      this.deleteAlertPage = true;
      this.deleteAlertPageId = id;
      this.deleteAlertPageText = `Deleting the Page will permanently removed from the database. You can't recover the
      page again. Are you sure about deleting?`;
      setTimeout(() => (this.deleteAlertPage = false), 5000);
    },
    deletePageConfirm() {
      router.delete(
        `/admin-dashboard/pages/custom-page-content/${this.deleteAlertPageId}`
      );
    },
    updateCustomPageContent() {
      if (this.image) {
        this.customPageContentInfo.image = this.image[0];
        this.oldImage = URL.createObjectURL(this.image[0]);
      } else {
        delete this.customPageContentInfo.image;
      }
      this.customPageContentInfo._method = "put";
      router.post(
        `/admin-dashboard/pages/custom-page-content/${this.customPageContentInfo.id}`,
        this.customPageContentInfo,
        {
          preserveState: true,
          preserveScroll: true,
          only: ["customPageContent", "flash", "errors"],
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
import FormTextArea from "../FormComponents/FormTextArea.vue";

import FormInput from "../FormComponents/FormInput.vue";
import FormFileUploadSingle from "../FormComponents/FormFileUploadSingle.vue";
import FormTextEditor from "../FormComponents/FormTextEditor.vue";

import Button from "../FormComponents/Button.vue";
import Errors from "../FormComponents/Errors.vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import AlertDelete from "./AlertDelete.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
