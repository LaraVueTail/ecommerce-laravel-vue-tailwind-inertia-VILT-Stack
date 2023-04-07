<template>
  <section class="dark:bg-gray-900 h-screen overflow-x-hidden md:overflow-x-visible p-1">
    <div class="mx-auto max-w-screen-xl px-1 lg:px-12 my-11 pb-11">
      <!-- Modal content -->

      <Breadcrump :links="{ users: 'users', 'Create User': '' }"></Breadcrump>

      <div
        class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5"
      >
        <!-- Modal header -->
        <ModalHeader :heading="'Create user'" :url="$page.url"></ModalHeader>

        <!-- Modal body -->
        <form action="#" @submit.prevent="">
          <div>
            <div class="mb-4">
              <div class="grid gap-4 mb-4 sm:grid-cols-5">
                <div class="grid sm:col-span-3 pr-4 border-r">
                  <!-- product general details  -->
                  <div>
                    <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                      User General Details:
                    </p>
                    <div class="grid gap-4 sm:grid-cols-2">
                      <FormInput
                        :label="'First Name'"
                        :name="'first_name'"
                        :type="'text'"
                        v-model="userInfo.first_name"
                        :error="errors.first_name"
                      ></FormInput>
                      <FormInput
                        :label="'Last Name'"
                        :name="'last_name'"
                        :type="'text'"
                        v-model="userInfo.last_name"
                        :error="errors.last_name"
                      ></FormInput>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                      <FormInput
                        :label="'Email'"
                        :name="'email'"
                        :type="'email'"
                        v-model="userInfo.email"
                        :error="errors.email"
                      ></FormInput>
                      <FormInput
                        :label="'Phone Number'"
                        :name="'phone_number'"
                        :type="'number'"
                        v-model="userInfo.phone_number"
                        :error="errors.phone_number"
                      ></FormInput>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                      <FormInput
                        :label="'Date of Birth'"
                        :name="'birthday'"
                        :type="'date'"
                        v-model="userInfo.birthday"
                        :error="errors.birthday"
                      ></FormInput>
                      <FormInput
                        :label="'Gender'"
                        :name="'gender'"
                        :type="'text'"
                        v-model="userInfo.gender"
                        :error="errors.gender"
                      ></FormInput>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                      <FormInput
                        :label="'Password'"
                        :name="'password'"
                        :type="'password'"
                        v-model="userInfo.password"
                        :error="errors.password"
                      ></FormInput>
                      <FormInput
                        :label="'Confirm Password'"
                        :name="'confirm_password'"
                        :type="'password'"
                        v-model="userInfo.confirm_password"
                        :error="errors.confirm_password"
                      ></FormInput>
                    </div>
                  </div>
                </div>

                <div class="grid sm:col-span-2">
                  <div>
                    <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                      Profile Picture:
                    </p>

                    <FormFileUploadSingle
                      @fileChange="(file) => (this.userInfo.thumbnail = file)"
                      :label="'Profile Picture'"
                      :name="'profile_picture'"
                      :error="errors.profile_picture ?? errors['profile_picture.0']"
                    ></FormFileUploadSingle>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div>
            <Errors :errors="errors ?? false"></Errors>
            <div class="flex items-center space-x-4">
              <Button
                @click.prevent="createUser()"
                :text="'Create User'"
                :color="'blue'"
              ></Button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
export default {
  props: ["errors", "categories"],
  data() {
    return {
      userInfo: {},
      form: {},
      newAttribute: {},
      productAttributes: {},
      addedImages: [],
      addedThumbnail: null,
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
      this.userInfo.slug = this.slugify(this.userInfo.name);
    },
    changeToSlug() {
      if (this.userInfo.slug !== "") {
        this.userInfo.slug = this.slugify(this.userInfo.slug);
      } else {
        this.userInfo.slug = this.slugify(this.userInfo.name);
      }
    },
    addProductAttribute() {
      if (this.newAttribute.attribute_label && this.newAttribute.attribute_value) {
        this.productAttributes[
          this.newAttribute.attribute_label
        ] = this.newAttribute.attribute_value;
        this.newAttribute = {};
      }
      console.log(this.productAttributes);
    },
    deleteProductAttribute(key) {
      delete this.productAttributes[key];
    },
    createProduct() {
      this.userInfo.product_details = JSON.stringify(this.productAttributes);
      console.log(this.userInfo);
      this.form = useForm(this.userInfo);
      this.form.post(`/admin-dashboard/users`, {
        preserveScroll: true,
      });
    },
  },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import Breadcrump from "../../../Shared/AdminDashboardLayoutComponents/Breadcrump.vue";
import ModalHeader from "../../../Shared/AdminDashboardLayoutComponents/ModalHeader.vue";
import FormInput from "../../../Shared/AdminDashboardLayoutComponents/FormInput.vue";
import FormSelect from "../../../Shared/AdminDashboardLayoutComponents/FormSelect.vue";
import FormTextArea from "../../../Shared/AdminDashboardLayoutComponents/FormTextArea.vue";
import FormFileUploadSingle from "../../../Shared/AdminDashboardLayoutComponents/FormFileUploadSingle.vue";
import FormFileUploadMultiple from "../../../Shared/AdminDashboardLayoutComponents/FormFileUploadMultiple.vue";
import Button from "../../../Shared/AdminDashboardLayoutComponents/Button.vue";
import Errors from "../../../Shared/AdminDashboardLayoutComponents/Errors.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
