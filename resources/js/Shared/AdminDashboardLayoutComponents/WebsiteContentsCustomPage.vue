<template>
  <div
    class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5 my-10"
  >
    <!-- Modal header -->
    <ModalHeader
      :heading="`Custom Page ${customPageContentInfo.name}`"
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
                :error="this.customPageContentsErrors.name"
              ></FormInput>
              <FormInput
                :label="'Page Slug'"
                :name="'slug'"
                :type="'text'"
                @change="changeToSlug()"
                :placeholder="'page_slug'"
                v-model="customPageContentInfo.slug"
                :error="this.customPageContentsErrors.slug"
              ></FormInput>
              <FormInput
                :label="'Title'"
                :name="'title'"
                :type="'text'"
                :placeholder="'Page Title'"
                v-model="customPageContentInfo.title"
                :error="this.customPageContentsErrors.title"
              ></FormInput>
              <FormTextArea
                :label="'Sub title'"
                :name="'sub_title'"
                v-model="customPageContentInfo.sub_title"
                :row="'3'"
                :placeholder="'Sub title'"
                :error="this.customPageContentsErrors.sub_title"
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
                :error="this.customPageContentsErrors.image"
              ></FormFileUploadSingle>
            </div>
            <FormTextEditor
              v-model="customPageContentInfo.content"
              :label="'Main Content'"
              :name="'main_content'"
              :error="this.customPageContentsErrors.content"
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
  props: ["customPageContentsErrors", "customPageContent"],
  data() {
    return {
      customPageContentInfo: this.customPageContent,
      image: false,
      oldImage: this.customPageContent.image_url,
      errors: this.customPageContentsErrors ?? {},
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
    updateCustomPageContent() {
      if (this.image) {
        this.customPageContentInfo.image = this.image[0];
        this.oldImage = URL.createObjectURL(this.image[0]);
      } else {
        delete this.customPageContentInfo.image;
      }
      this.customPageContentInfo._method = "put";
      router.post(
        `/admin-dashboard/custom-page-contents/${this.customPageContentInfo.id}`,
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
import FormTextArea from "./FormTextArea.vue";

import FormInput from "./FormInput.vue";
import FormFileUploadSingle from "./FormFileUploadSingle.vue";
import FormTextEditor from "./FormTextEditor.vue";

import Button from "./Button.vue";
import Errors from "./Errors.vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
