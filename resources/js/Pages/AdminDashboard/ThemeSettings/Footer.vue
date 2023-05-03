<template>
  <EditSectionLayout>
    <Breadcrump :links="{ 'Theme Settings': null, 'Edit Footer': null }"></Breadcrump>

    <div
      class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5 my-10"
    >
      <!-- Modal header -->
      <ModalHeader :heading="'Footer'" :url="$page.url"></ModalHeader>
      <!-- Modal body -->
      <form action="#" @submit.prevent="">
        <div>
          <div class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-2">
            <div class="pr-8 md:border-r">
              <p class="font-medium text-blue-600 dark:text-gray-400 my-4">Page Links:</p>
              <!-- add product attributes  -->
              <div>
                <div class="p-2" v-for="(link, index) in pageLinks" :key="index">
                  <div class="grid sm:grid-cols-12 gap-8">
                    <div class="col-span-5">
                      <label
                        for="page_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Page Name</label
                      >
                      <input
                        type="text"
                        name="page_name"
                        id="page_name"
                        v-model="link.pageName"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Years/Staffs.."
                      />
                    </div>
                    <div class="col-span-6">
                      <label
                        for="page_link"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Page Link</label
                      >
                      <input
                        type="text"
                        name="page_link"
                        id="page_link"
                        v-model="link.pageLink"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder=""
                      />
                    </div>

                    <div class="self-end place-self-center">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6 text-red-600 m-3 hover:text-red-800 cursor-pointer"
                        @click="removePageLink(index)"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                        />
                      </svg>
                    </div>
                  </div>
                </div>

                <div class="p-2">
                  <div class="grid sm:grid-cols-12 gap-8">
                    <div class="col-span-5">
                      <label
                        for="page_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Page Name</label
                      >
                      <input
                        type="text"
                        name="page_name"
                        id="page_name"
                        v-model="linkName"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder=""
                      />
                    </div>
                    <div class="col-span-6">
                      <label
                        for="page_link"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Page Link</label
                      >
                      <input
                        type="text"
                        name="page_link"
                        id="page_link"
                        v-model="linkLink"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder=""
                      />
                    </div>

                    <div class="self-end place-self-center">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        class="w-10 h-10 text-blue-700"
                        @click="addPageLink"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z"
                          clip-rule="evenodd"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="grid">
              <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                Social Links:
              </p>
              <div>
                <div class="p-2" v-for="(link, index) in socialLinks" :key="index">
                  <div class="grid sm:grid-cols-12 gap-8">
                    <div class="self-center place-self-center">
                      <i
                        :class="`fa-brands fa-${link.socialName} text-2xl text-gray-800`"
                      ></i>
                    </div>
                    <div class="col-span-11">
                      <input
                        type="text"
                        name="page_link"
                        id="page_link"
                        v-model="link.socialLink"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder=""
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <Errors :errors="$page.props.errors ?? false"></Errors>
          <div class="flex items-center space-x-4">
            <Button
              @click.prevent="updateFooter()"
              :text="'Update Footer'"
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
  props: ["footerContent"],
  data() {
    return {
      footerContentInfo: this.footerContent,
      pageLinks: JSON.parse(this.footerContent.pageLinks),
      socialLinks: JSON.parse(this.footerContent.socialLinks),
      linkName: "",
      linkLink: "",
    };
  },
  methods: {
    addPageLink() {
      if (this.linkName && this.linkLink) {
        let newPageLink = {};
        newPageLink.pageName = this.linkName;
        newPageLink.pageLink = this.linkLink;
        this.pageLinks.push(newPageLink);
        this.linkName = this.linkLink = "";
        newPageLink = {};
      }
    },
    removePageLink(index) {
      if (index > -1) {
        this.pageLinks.splice(index, 1);
      }
    },
    updateFooter() {
      this.footerContentInfo.pageLinks = JSON.stringify(this.pageLinks);
      this.footerContentInfo.socialLinks = JSON.stringify(this.socialLinks);
      this.footerContentInfo._method = "put";
      router.post(`/admin-dashboard/theme-settings/footer/1`, this.footerContentInfo, {
        preserveState: true,
        preserveScroll: true,
        only: ["footerContent", "flash", "errors"],
      });
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
