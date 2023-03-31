<template>
  <div>
    <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{
      label
    }}</label>
    <input
      class="mb-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
      :class="{
        'border-2 border-rose-500': error && (!addedFile || addedFile[0].size > 2500000),
      }"
      :id="name"
      type="file"
      ref="fileInput"
      accept="image/png, image/jpeg"
      @input="fileAdded($event.target.files)"
    />
    <div
      v-if="error && !addedFile"
      v-text="error"
      class="text-red-500 text-xs my-1"
    ></div>
    <div v-if="errorSize" class="text-red-500 text-xs my-1">
      Upload file less than 2MB
    </div>

    <div
      class="relative text-white hover:text-red-600 cursor-pointer mt-3 mb-10"
      v-if="addedFile || fileUrl"
    >
      <div
        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          fill="currentColor"
          class="w-6 h-6"
          @click="fileRemoved()"
        >
          <path
            fill-rule="evenodd"
            d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
            clip-rule="evenodd"
          />
        </svg>
      </div>
      <div
        class="bg-contain bg-center bg-no-repeat shadow-2xl saturate-50 bg-blend-overlay bg-gray-900/75 h-48 w-full rounded-lg"
        :style="`background-image: url(${uploadedImage()})`"
      ></div>
    </div>
  </div>
</template>

<script>
import { FlagIcon } from "@heroicons/vue/20/solid";
export default {
  props: ["label", "error", "name", "fileUrl"],
  data() {
    return {
      addedFile: null,
      errorSize: false,
    };
  },
  emits: ["fileChange"],
  methods: {
    fileAdded(files) {
      this.errorSize = false;
      if (files[0].size > 2500000) {
        this.errorSize = true;
      }
      if (!this.errorSize) {
        this.addedFile = files;

        console.log(this.addedFile[0].size);
        this.$emit("fileChange", this.addedFile);
      }
    },
    fileRemoved() {
      this.errorSize = false;
      this.addedFile = null;

      this.$refs.fileInput.value = "";
      this.$emit("fileChange", this.addedFile);
    },
    uploadedImage() {
      if (this.addedFile) {
        return URL.createObjectURL(this.addedFile[0]);
      } else if (this.fileUrl) {
        return this.fileUrl;
      } else {
        return "";
      }
    },
  },
};
</script>
