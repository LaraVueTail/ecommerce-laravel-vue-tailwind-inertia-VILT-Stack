<template>
  <div
    class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5"
  >
    <!-- Modal body -->
    <form action="#" @submit.prevent="">
      <div>
        <div class="grid gap-4 mb-4">
          <div class="pr-5 border-r">
            <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
              Shipping Address:
            </p>

            <div class="grid gap-4 sm:grid-cols-2">
              <FormInput
                :label="'Address Line 1'"
                :name="'address_line_1'"
                :type="'text'"
                v-model="userInfo.address_line_1"
              ></FormInput>
              <FormInput
                :label="'Address Line 2'"
                :name="'address_line_2'"
                :type="'text'"
                v-model="userInfo.address_line_2"
              ></FormInput>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
              <FormInput
                :label="'City'"
                :name="'city'"
                :type="'text'"
                v-model="userInfo.city"
              ></FormInput>
              <FormInput
                :label="'Pin code'"
                :name="'pin_code'"
                :type="'text'"
                v-model="userInfo.pin_code"
              ></FormInput>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
              <FormInput
                :label="'Country'"
                :name="'country'"
                :type="'text'"
                v-model="userInfo.country"
              ></FormInput>
            </div>
          </div>
        </div>
      </div>

      <div>
        <Errors :errors="errors ?? false"></Errors>

        <div class="flex items-center space-x-4">
          <Button
            @click.prevent="updateAddress()"
            :text="'Update'"
            :color="'blue'"
          ></Button>
        </div>
      </div>
    </form>
  </div>
  <!-- Modal content -->
</template>
<script>
import { router } from "@inertiajs/vue3";
export default {
  props: ["errors", "user"],
  data() {
    return {
      userInfo: this.user,
      form: {},
    };
  },
  methods: {
    updateAddress() {
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
import FormInput from "../../../Shared/FormComponents/FormInput.vue";
import Button from "../../../Shared/FormComponents/Button.vue";
import Errors from "../../../Shared/FormComponents/Errors.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
