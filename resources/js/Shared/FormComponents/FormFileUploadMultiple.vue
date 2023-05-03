<template>
  <div>
    <div>
      <label
        for=""
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        >{{ label }}</label
      >
      <div class="flex items-center justify-center w-full">
        <label
          :for="name"
          :class="{
            'border-2 border-rose-500': (error && addedFiles.length < 1) || errorSize,
          }"
          class="flex flex-col items-center justify-center w-full h-34 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
        >
          <div class="flex flex-col items-center justify-center pt-5 pb-6">
            <svg
              aria-hidden="true"
              class="w-10 h-10 mb-3 text-gray-400"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
              ></path>
            </svg>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
              <span class="font-semibold">Click to upload</span>
              or drag and drop
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-400">
              SVG, PNG, JPG or GIF (MAX. 800x400px)
            </p>
          </div>
          <input
            :id="name"
            type="file"
            class="hidden"
            accept="image/png, image/jpeg"
            @input="fileAdded($event.target.files)"
            multiple
          />
        </label>
      </div>

      <div
        v-if="error && addedFiles.length < 1"
        v-text="error"
        class="text-red-500 text-xs my-2"
      ></div>
      <div v-if="errorSize" class="text-red-500 text-xs my-2">{{ errorSizeText }}</div>
    </div>

    <AlertDelete
      class="my-4"
      v-if="deleteImageAlert"
      @close="deleteImageAlert = false"
      @confirm="deleteImageConfirm"
      :text="deleteImageAlertText"
    ></AlertDelete>

    <div class="grid grid-cols-2 gap-2 py-2 justify-items-stretch">
      <div v-for="(file, index) in addedFiles" :key="file">
        <div class="relative text-white hover:text-red-600 cursor-pointer">
          <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="currentColor"
              class="w-6 h-6"
              @click="fileAddedFilesRemove(index)"
            >
              <path
                fill-rule="evenodd"
                d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                clip-rule="evenodd"
              />
            </svg>
          </div>
          <div
            class="bg-cover bg-center shadow-2xl saturate-50 bg-blend-overlay bg-gray-900/75 h-24 w-full rounded-lg"
            :style="`background-image: url(${uploadedImage(file)})`"
          ></div>
        </div>
      </div>
    </div>

    <label
      for=""
      class="block my-2 text-sm font-medium text-gray-900 dark:text-white"
      v-if="oldImages.length > 0"
      >Current Images</label
    >

    <div
      class="grid grid-cols-2 gap-2 py-2 justify-items-stretch"
      v-if="oldImages.length"
    >
      <div v-for="(imageSrc, index) in oldImages" :key="imageSrc">
        <div class="relative text-white hover:text-red-600 cursor-pointer">
          <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="currentColor"
              class="w-6 h-6"
              @click="fileOldImagesRemove(imageSrc, index)"
            >
              <path
                fill-rule="evenodd"
                d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                clip-rule="evenodd"
              />
            </svg>
          </div>
          <div
            class="bg-cover bg-center shadow-2xl saturate-50 bg-blend-overlay bg-gray-900/75 h-24 w-full rounded-lg"
            :style="`background-image: url(${imageSrc})`"
          ></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { router } from "@inertiajs/vue3";

export default {
  props: [
    "label",
    "error",
    "name",
    "oldImageUrls",
    "deleteImageUrl",
    "preserveStateData",
  ],
  data() {
    return {
      addedFiles: [],
      oldImages: this.oldImageUrls ?? [],
      errorSize: false,
      errorSizeText: "",
      deleteImageAlert: false,
      deleteImageAlertText: "",
      imageUrl: null,
    };
  },
  emits: ["files-change", "files-delete"],
  methods: {
    fileAdded(files) {
      console.log(files);
      this.errorSize = false;
      Array.from(files).forEach((file) => {
        if (file.size > 2500000) {
          this.errorSize = true;
          this.errorSizeText = "Upload image with size less than 2MB";
        }
      });
      if (!this.errorSize) {
        this.addedFiles.push.apply(this.addedFiles, files);
        console.log(this.addedFiles);

        this.$emit("files-change", this.addedFiles);
      }
    },
    fileAddedFilesRemove(index) {
      this.errorSize = false;
      if (index !== -1) {
        this.addedFiles.splice(index, 1);
      }
    },
    fileOldImagesRemove(imageUrl, index) {
      if (index !== -1) {
        // this.oldImages.splice(index, 1);
        console.log(imageUrl);
        this.deleteImageAlert = true;
        this.imageUrl = imageUrl;
        this.deleteImageAlertText = `Deleting the image will permanently removed from the database. You can't recover the
      image again. Are you sure about deleting?`;
        setTimeout(() => (this.deleteImageAlert = false), 5000);
        this.$emit("files-delete", imageUrl);
      }
    },
    deleteImageConfirm() {
      router.put(
        this.deleteImageUrl,
        {
          imageUrl: this.imageUrl,
        },
        {
          preserveState: false,
          preserveScroll: true,
          only: [this.preserveStateData],
        }
      );
      this.imageUrl = null;
    },
    uploadedImage(file) {
      if (file) {
        return URL.createObjectURL(file);
      } else {
        return "";
      }
    },
  },
};
</script>

<script setup>
import AlertDelete from "../AdminDashboardLayoutComponents/AlertDelete.vue";
</script>
