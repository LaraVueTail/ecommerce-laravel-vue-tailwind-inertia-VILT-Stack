<template>
  <section class="bg-gray-50 dark:bg-gray-900">
    <div
      class="flex flex-col items-center justify-center px-6 py-2 mx-auto h-screen md:h-[768px] lg:py-0"
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
        class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"
      >
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1
            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
          >
            Sign in to your account
          </h1>
          <form class="space-y-4 md:space-y-6" action="#" @submit.prevent="">
            <div>
              <FormInputVue
                :label="'Your Email'"
                :name="'email'"
                :type="'email'"
                v-model="loginInfo.email"
                :error="errors.email"
              >
              </FormInputVue>
            </div>
            <div>
              <FormInputVue
                :label="'Password'"
                :name="'password'"
                :type="'password'"
                v-model="loginInfo.password"
                :error="errors.password"
              >
              </FormInputVue>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-start">
                <div class="flex items-center h-5">
                  <input
                    id="remember"
                    aria-describedby="remember"
                    type="checkbox"
                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                  />
                </div>
                <div class="ml-3 text-sm">
                  <label for="remember" class="text-gray-500 dark:text-gray-300"
                    >Remember me</label
                  >
                </div>
              </div>
              <a
                href="#"
                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500"
                >Forgot password?</a
              >
            </div>
            <button
              type="submit"
              @click="login()"
              class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              Sign in
            </button>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
              Don’t have an account yet?
              <Link
                href="/register"
                class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                >Sign up
              </Link>
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { router } from "@inertiajs/vue3";

export default {
  data() {
    return {
      loginInfo: {},
      errors: this.$page.props.errors,
    };
  },
  methods: {
    login() {
      router.post("/login", this.loginInfo, {
        preserveScroll: true,
        preserveState: false,
        only: ["errors"],
      });
    },
  },
};
</script>
<script setup>
import FormInputVue from "../../Shared/FormComponents/FormInput.vue";
</script>
