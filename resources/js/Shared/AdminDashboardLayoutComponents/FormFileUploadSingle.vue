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
      ref="fileInputSingle"
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
      v-if="addedFile || oldImage"
    >
      <div
        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          fill="currentColor"
          class="w-6 h-6"
          @click="$refs.fileInputSingle.click()"
        >
          <path
            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z"
          />
          <path
            d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z"
          />
        </svg>
      </div>
      <div
        class="bg-contain bg-center bg-no-repeat shadow-2xl saturate-50 bg-blend-overlay bg-gray-900/75 h-48 w-full rounded-lg"
        :style="`background-image: url(${uploadedFile()})`"
      ></div>
    </div>
  </div>
</template>

<script>
import { FlagIcon } from "@heroicons/vue/20/solid";
export default {
  props: ["label", "error", "name", "oldImageLink"],
  data() {
    return {
      addedFile: null,
      errorSize: false,
      oldImage: this.oldImageLink,
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
        console.log(this.addedFile);
        this.$emit("fileChange", this.addedFile);
      }
    },
    fileRemoved() {
      this.errorSize = false;
      this.addedFile = null;
      this.oldImage = null;
      this.$refs.fileInput.value = "";
    },
    uploadedFile() {
      if (this.addedFile) {
        return URL.createObjectURL(this.addedFile[0]);
      } else if (this.oldImage) {
        console.log(this.oldImage);
        return this.oldImage;
      } else {
        return "";
      }
    },
  },
};
</script>
