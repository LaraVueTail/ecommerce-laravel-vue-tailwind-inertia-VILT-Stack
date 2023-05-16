<template>
  <section class="bg-gray-50 dark:bg-gray-900">
    <div
      class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen lg:py-0"
    >
      <a
        href="#"
        class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white"
      >
        <img
          class="w-8 h-8 mr-2"
          src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg"
          alt="logo"
        />
        Flowbite
      </a>
      <div
        class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-lg xl:p-0 dark:bg-gray-800 dark:border-gray-700"
      >
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1
            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
          >
            Create and account
          </h1>
          <form class="space-y-4 md:space-y-6" action="#" @submit.prevent="">
            <div class="grid md:grid-cols-2 gap-3">
              <div>
                <FormInput
                  :label="'First Name'"
                  :name="'first_name'"
                  :type="'text'"
                  v-model="registerInfo.first_name"
                  :error="$page.props.errors.first_name"
                >
                </FormInput>
              </div>
              <div>
                <FormInput
                  :label="'Last Name'"
                  :name="'last_name'"
                  :type="'text'"
                  v-model="registerInfo.last_name"
                  :error="$page.props.errors.last_name"
                >
                </FormInput>
              </div>
            </div>
            <div class="grid md:grid-cols-2 gap-3">
              <div>
                <FormInput
                  :label="'Your Email'"
                  :name="'email'"
                  :type="'email'"
                  v-model="registerInfo.email"
                  :error="$page.props.errors.email"
                >
                </FormInput>
              </div>
              <div>
                <FormInput
                  :label="'Phone Number'"
                  :name="'phone_number'"
                  :type="'text'"
                  v-model="registerInfo.phone_number"
                  :error="$page.props.errors.phone_number"
                >
                </FormInput>
              </div>
            </div>
            <div class="grid md:grid-cols-2 gap-3">
              <FormInput
                :label="'Password'"
                :name="'password'"
                :type="'password'"
                v-model="registerInfo.password"
                :error="$page.props.errors.password"
              >
              </FormInput>
              <FormInput
                :label="'Confirm Password'"
                :name="'confirm_password'"
                :type="'password'"
                v-model="registerInfo.password_confirmation"
                :error="$page.props.errors.password_confirmation"
              ></FormInput>
            </div>

            <FormCheckBox
              :label="'I accept theTerms and Conditions'"
              :name="'tac'"
              :checked="registerInfo.tac"
              v-model="registerInfo.tac"
              :error="$page.props.errors.tac"
            >
            </FormCheckBox>
            <button
              type="submit"
              @click="register()"
              class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              Create an account
            </button>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
              Already have an account?
              <Link
                href="/login"
                class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                >Login here</Link
              >
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  data() {
    return {
      registerInfo: {},
    };
  },
  methods: {
    register() {
      console.log(this.registerInfo);
      router.post("/register", this.registerInfo, {
        preserveScroll: true,
        preserveState: true,
      });
    },
  },
  components: { Link },
};
</script>
<script setup>
import { Link, router } from "@inertiajs/vue3";
import FormInput from "../../Shared/FormComponents/FormInput.vue";
import FormCheckBox from "../../Shared/FormComponents/FormCheckBox.vue";
</script>
