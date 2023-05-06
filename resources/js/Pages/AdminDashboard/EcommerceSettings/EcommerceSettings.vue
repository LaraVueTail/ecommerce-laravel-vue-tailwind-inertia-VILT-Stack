<template>
  <EditSectionLayout>
    <Breadcrump :links="{ 'E-Commerce Settings': null }"></Breadcrump>

    <div
      class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5 my-10"
    >
      <!-- Modal header -->
      <ModalHeader :heading="'E-Commerce Settings'" :url="$page.url"></ModalHeader>
      <!-- Modal body -->
      <form action="#" @submit.prevent="">
        <div>
          <div class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-2">
            <div class="pr-5 md:border-r">
              <div class="grid gap-4">
                <FormSelect
                  :label="'Choose currency'"
                  :name="'currency'"
                  v-model="ecommerceSettingsInfo.currency"
                  :selected="ecommerceSettingsInfo.currency"
                  :optionsArray="currenciesArray"
                  :optionName="'name'"
                  :optionValue="'value'"
                >
                </FormSelect>
              </div>
            </div>
            <div>
              <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                Payment Options
              </p>

              <div class="grid gap-4">
                <FormCheckBox
                  :label="'Enable/Edit Stripe Payment'"
                  :name="'enable_stripe'"
                  :checked="ecommerceSettingsInfo.enable_stripe"
                  v-model="ecommerceSettingsInfo.enable_stripe"
                  :error="$page.props.errors.enable_stripe"
                >
                </FormCheckBox>
                <FormInput
                  :label="'Stripe Secret Key'"
                  :name="'stripe_secrete_key'"
                  :type="'text'"
                  :disabled="!ecommerceSettingsInfo.enable_stripe"
                  v-model="ecommerceSettingsInfo.stripe_secret_key"
                  :error="$page.props.errors.stripe_secret_key"
                ></FormInput>

                <FormCheckBox
                  :label="'Enable Order on WhatsApp'"
                  :name="'enable_whatsapp'"
                  :checked="ecommerceSettingsInfo.enable_whatsapp"
                  v-model="ecommerceSettingsInfo.enable_whatsapp"
                  :error="$page.props.errors.enable_whatsapp"
                >
                </FormCheckBox>
                <p class="text-sm text-red-600">
                  <b>Note: </b><br />Enter Whatsnumber with country code (without any
                  symbols (+,- etc)).<br />
                  ex: if <b>+91</b> is your country code provide <b>91XXXXXXXX</b> as
                  Whatsap number
                </p>
                <div class="flex gap-4 items-center">
                  <i class="fa-brands fa-whatsapp text-4xl text-green-600 mt-2"></i>
                  <FormInput
                    :label="'WhatsApp Number'"
                    :name="'whatsapp_number'"
                    :type="'text'"
                    :disabled="!ecommerceSettingsInfo.enable_whatsapp"
                    v-model="ecommerceSettingsInfo.whatsapp_number"
                    :error="$page.props.errors.whatsapp_number"
                  ></FormInput>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <Errors :errors="$page.props.errors ?? false"></Errors>
          <div class="flex items-center space-x-4">
            <Button
              @click.prevent="updateEcommerceSettings()"
              :text="'Update E-Commerce Settings'"
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
  components: { FormCheckBox },
  props: ["ecommerceSettings"],
  data() {
    return {
      ecommerceSettingsInfo: this.ecommerceSettings,
    };
  },
  computed: {
    currenciesArray() {
      var currenciesArray = [];
      var inputArray = JSON.parse(this.ecommerceSettingsInfo.available_currencies);
      console.log(inputArray);
      Object.keys(inputArray).forEach(function (key, index) {
        currenciesArray.push({
          value: key,
          name: inputArray[key],
        });
      });
      console.log(this.currenciesArray);
      return currenciesArray;
    },
  },
  methods: {
    updateEcommerceSettings() {
      this.ecommerceSettingsInfo._method = "put";
      router.post(`/admin-dashboard/ecommerce-settings`, this.ecommerceSettingsInfo, {
        preserveState: true,
        preserveScroll: true,
        only: ["ecommerceSettings", "flash", "errors"],
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
