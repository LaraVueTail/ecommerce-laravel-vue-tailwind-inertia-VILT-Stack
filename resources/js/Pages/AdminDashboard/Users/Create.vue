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
                      @fileChange="(file) => (userInfo.avatar = file[0])"
                      :label="'Profile Picture'"
                      :name="'avatar'"
                      :error="errors.avatar"
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
  props: ["errors"],
  data() {
    return {
      userInfo: {},
      form: {},
    };
  },
  methods: {
    createUser() {
      this.userInfo.tac = true;
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
import Breadcrump from "../../../Shared/AdminDashboardComponents/Breadcrump.vue";
import ModalHeader from "../../../Shared/AdminDashboardComponents/ModalHeader.vue";
import FormInput from "../../../Shared/FormComponents/FormInput.vue";
import FormFileUploadSingle from "../../../Shared/FormComponents/FormFileUploadSingle.vue";
import Button from "../../../Shared/FormComponents/Button.vue";
import Errors from "../../../Shared/FormComponents/Errors.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
