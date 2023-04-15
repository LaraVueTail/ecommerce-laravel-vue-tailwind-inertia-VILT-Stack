<template>
  <!-- login -->
  <div class="min-h-screen md:bg-gray-800">
    <div class="contain py-10 mb-5 px-4 md:px-64">
      <div
        class="bg-white max-w-md mx-auto md:shadow-xl px-6 py-7 rounded overflow-hidden"
      >
        <h2 class="text-xl text-center md:text-2xl uppercase font-medium mb-1">
          Register Now
        </h2>
        <p class="text-gray-600 mb-6 text-sm text-center">create an account</p>
        <form action="#" method="post" autocomplete="off" @submit.prevent="submit">
          <div class="space-y-2">
            <div>
              <label for="first_name" class="text-gray-600 mb-2 block">First name</label>
              <input
                v-model="form.first_name"
                type="text"
                name="first_name"
                id="first_name"
                :class="{
                  'border-2 border-rose-500': form.errors.first_name,
                }"
                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                placeholder="aaa"
              />
              <div
                v-if="form.errors.first_name"
                v-text="form.errors.first_name"
                class="text-red-500 text-xs mt-1"
              ></div>
            </div>

            <div>
              <label for="last_name" class="text-gray-600 mb-2 block">Last name</label>
              <input
                v-model="form.last_name"
                type="text"
                name="last_name"
                id="last_name"
                :class="{
                  'border-2 border-rose-500': form.errors.last_name,
                }"
                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                placeholder="aa"
              />
              <div
                v-if="form.errors.last_name"
                v-text="form.errors.last_name"
                class="text-red-500 text-xs mt-1"
              ></div>
            </div>

            <div>
              <label for="last_name" class="text-gray-600 mb-2 block">Phone Number</label>
              <input
                v-model="form.phone_number"
                type="tel"
                pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                name="phone_number"
                id="phone_number"
                :class="{
                  'border-2 border-rose-500': form.errors.phone_number,
                }"
                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                placeholder="123-12-123"
              />
              <div
                v-if="form.errors.phone_number"
                v-text="form.errors.phone_number"
                class="text-red-500 text-xs mt-1"
              ></div>
            </div>

            <div>
              <label for="email" class="text-gray-600 mb-2 block">Email address</label>
              <input
                v-model="form.email"
                type="email"
                name="email"
                id="email"
                :class="{
                  'border-2 border-rose-500': form.errors.email,
                }"
                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                placeholder="youremail.@domain.com"
              />
              <div
                v-if="form.errors.email"
                v-text="form.errors.email"
                class="text-red-500 text-xs mt-1"
              ></div>
            </div>
            <div>
              <label for="password" class="text-gray-600 mb-2 block">Password</label>
              <input
                v-model="form.password"
                type="password"
                name="password"
                id="password"
                :class="{
                  'border-2 border-rose-500': form.errors.email,
                }"
                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                placeholder="*******"
              />
              <div
                v-if="form.errors.password"
                v-text="form.errors.password"
                class="text-red-500 text-xs mt-1"
              ></div>
            </div>
          </div>
          <!-- <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                name="remember"
                                id="remember"
                                class="text-primary focus:ring-0 rounded-sm cursor-pointer"
                            />
                            <label
                                for="remember"
                                class="text-gray-600 ml-2 cursor-pointer text-sm"
                                >Remember me</label
                            >
                        </div>
                        <a href="#" class="text-primary text-sm"
                            >Forgot password</a
                        >
                    </div> -->
          <div class="mt-4">
            <button
              type="submit"
              class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium text-sm"
            >
              Register
            </button>
          </div>
        </form>

        <p class="mt-4 text-center text-gray-600 text-sm">
          Already have an account?
          <Link href="login" class="text-primary text-sm">Login now</Link>
        </p>
      </div>
    </div>
  </div>
  <!-- ./login -->
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

let props = defineProps({
  csrf_token: String,
});

console.log(props);

let form = useForm({
  first_name: "",
  last_name: "",
  phone_number: "",
  email: "",
  password: "",
  _token: props.csrf_token,
});

let submit = () => {
  form.post("/register");
};
</script>
