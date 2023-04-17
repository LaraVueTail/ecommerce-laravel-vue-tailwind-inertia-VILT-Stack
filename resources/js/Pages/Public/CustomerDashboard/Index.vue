<template>
  <CustomerDashboardLayoutVue>
    <div
      class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5"
    >
      <!-- Modal header -->

      <!-- Modal body -->
      <form action="#" @submit.prevent="">
        <div>
          <div class="mb-4">
            <div class="grid gap-4 mb-4 sm:grid-cols-5">
              <div class="grid sm:col-span-3 pr-4 border-r">
                <!-- product general details  -->
                <div>
                  <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                    Account Info:
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
                      :label="'Change Password'"
                      :name="'password'"
                      :type="'password'"
                      v-model="userInfo.password"
                      :error="errors.password"
                    ></FormInput>
                    <FormInput
                      :label="'Confirm Password'"
                      :name="'confirm_password'"
                      :type="'password'"
                      v-model="userInfo.password_confirmation"
                      :error="errors.password_confirmation"
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
                    @fileChange="(file) => (this.avatar = file)"
                    :label="'Profile Picture'"
                    :oldImageLink="this.userInfo.avatar"
                    :rounded="true"
                    :name="'avatar'"
                    :error="errors.avatar ?? errors['avatar.0']"
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
              @click.prevent="updateUser()"
              :text="'Update'"
              :color="'blue'"
            ></Button>
          </div>
        </div>
      </form>
    </div>
  </CustomerDashboardLayoutVue>
</template>
<script>
import { router } from "@inertiajs/vue3";
export default {
  props: ["errors", "user"],
  data() {
    return {
      userInfo: this.user,
      form: {},
      avatar: false,
    };
  },
  methods: {
    updateUser() {
      if (this.avatar) {
        this.userInfo.avatar = this.avatar;
      } else {
        delete this.userInfo.avatar;
      }
      console.log(this.userInfo);
      this.userInfo._method = "put";
      router.post(`/admin-dashboard/users/${this.user.id}`, this.userInfo, {
        preserveState: false,
        preserveScroll: true,
      });
    },
  },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import ModalHeader from "../../../Shared/AdminDashboardLayoutComponents/ModalHeader.vue";
import FormInput from "../../../Shared/AdminDashboardLayoutComponents/FormInput.vue";
import FormFileUploadSingle from "../../../Shared/AdminDashboardLayoutComponents/FormFileUploadSingle.vue";
import Button from "../../../Shared/AdminDashboardLayoutComponents/Button.vue";
import Errors from "../../../Shared/AdminDashboardLayoutComponents/Errors.vue";
import CustomerDashboardLayoutVue from "../../../Shared/CustomerDashboard/CustomerDashboardLayout.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
